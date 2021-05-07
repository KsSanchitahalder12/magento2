<?php

namespace Admin\Grid\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Admin\Grid\Model\Post', 'Admin\Grid\Model\ResourceModel\Post');
    }
}
