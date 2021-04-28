<?php

namespace Demo\Crud\Model\ResourceModel\Post;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
        /**
         * Define resource model
         *
         * @return void
         */
        protected function _construct()
        {
                $this->_init('Demo\Crud\Model\Post', 'Demo\Crud\Model\ResourceModel\Post');
        }
}