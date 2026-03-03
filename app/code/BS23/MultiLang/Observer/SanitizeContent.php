<?php
namespace BS23\MultiLang\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;

class SanitizeContent implements ObserverInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        $content = $product->getData('content');
        if ($content === null) {
            return;
        }
        try {
            $sanitized = $this->sanitizeHtml($content);
            $product->setData('content', $sanitized);
        } catch (\Throwable $e) {
            $this->logger->error('MultiLang sanitize failed: ' . $e->getMessage());
        }
    }

    private function sanitizeHtml($html)
    {
        $allowedTags = ['p','br','strong','em','ul','ol','li','a','img','div','span','h1','h2','h3','h4','h5','h6','table','thead','tbody','tr','th','td','blockquote'];
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new \DOMXPath($doc);
        foreach ($xpath->query('//*') as $node) {
            if ($node->nodeType !== XML_ELEMENT_NODE) {
                continue;
            }
            if (!in_array($node->nodeName, $allowedTags, true)) {
                $node->parentNode->removeChild($node);
                continue;
            }
            if ($node->hasAttributes()) {
                $keep = [];
                foreach ($node->attributes as $attr) {
                    $name = strtolower($attr->name);
                    $value = $attr->value;
                    if (strpos($name, 'on') === 0) {
                        continue;
                    }
                    if ($name === 'style') {
                        continue;
                    }
                    if (in_array($name, ['href', 'src'], true) && preg_match('/^\s*javascript:/i', $value)) {
                        continue;
                    }
                    if (in_array($name, ['href','src','alt','title','width','height'], true)) {
                        $keep[$name] = $value;
                    }
                }
                while ($node->attributes->length) {
                    $node->removeAttributeNode($node->attributes->item(0));
                }
                foreach ($keep as $k => $v) {
                    $node->setAttribute($k, $v);
                }
            }
        }

        $body = '';
        $bodyNode = $doc->getElementsByTagName('body')->item(0);
        if ($bodyNode) {
            foreach ($bodyNode->childNodes as $child) {
                $body .= $doc->saveHTML($child);
            }
        } else {
            $body = $doc->saveHTML();
        }

        return $body;
    }
}
