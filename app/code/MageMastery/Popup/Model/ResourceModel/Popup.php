<?php

namespace MageMastery\Popup\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Popup extends AbstractDb
{

    private const TABLE_NAME = 'magemastery_popup';
    private const PRIMARY_KEY = 'popup_id';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::PRIMARY_KEY);
    }


}
