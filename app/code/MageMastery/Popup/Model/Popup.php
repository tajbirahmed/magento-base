<?php
namespace MageMastery\Popup\Model;

use MageMastery\Popup\Api\Data\PopupInterface;
use Magento\Framework\Model\AbstractModel;
use \MageMastery\Popup\Model\ResourceModel\Popup as PopupResource;

class Popup extends AbstractModel implements PopupInterface
{

    private const POPUP_ID = 'popup_id';
    private const NAME = 'name';
    private const CONTENT = 'content';
    private const IS_ACTIVE = 'is_active';
    private const TIMEOUT = 'timeout';
    private const CREATED_AT = 'created_at';
    private const UPDATED_AT = 'updated_at';

    protected function _construct()
    {
        $this->_eventPrefix = 'magemastery_popup';
        $this->_eventObject = 'popup';
        $this->idFieldName = 'popup_id';
        $this->_init(PopupResource::class);
    }

    public function getId(): int
    {
        return (int) $this->getData(self::POPUP_ID);
    }

    public function setId($popupId): void
    {
        $this->setData(self::POPUP_ID, (int) $popupId);
    }

    public function getName(): string
    {
        return (string) $this->getData(self::NAME);
    }

    public function setName(string $title): void
    {
        $this->setData(self::NAME, $title);
    }

    public function getContent(): string
    {
        return (string) $this->getData(self::CONTENT);
    }

    public function setContent(string $content): void
    {
        $this->setData(self::CONTENT, $content);
    }

    public function getIsActive(): bool
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    public function setIsActive(bool $isActive): void
    {
        $this->setData(self::IS_ACTIVE, $isActive);
    }

    public function getCreatedAt(): string
    {
        return (string) $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    public function getUpdatedAt(): string
    {
        return (string) $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }

    public function getTimeout(): int
    {
        return (int) $this->getData(self::TIMEOUT);
    }

    public function setTimeout(int $timeout): void
    {
        $this->setData(self::TIMEOUT, $timeout);
    }
}
