<?php

namespace Admin\Grid\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('admin_grid_post', 'post_id');
    }
}
