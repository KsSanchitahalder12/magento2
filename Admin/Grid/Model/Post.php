<?php

namespace Admin\Grid\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'ADMIN_GRID';

    protected function _construct()
    {
        $this->_init('Admin\Grid\Model\ResourceModel\Post');
    }
 
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
 
    public function getDefaultValues()
    {
        $values = [];
 
        return $values;
    }
}
