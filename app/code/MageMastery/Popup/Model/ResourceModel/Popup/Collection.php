<?php

namespace MageMastery\Popup\Model\ResourceModel\Popup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Popup Collection
 * @package MageMastery\Popup\Model\ResourceModel\Popup
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \MageMastery\Popup\Model\Popup::class,
            \MageMastery\Popup\Model\ResourceModel\Popup::class
        );
    }
}
