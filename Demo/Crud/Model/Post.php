<?php

namespace Demo\Crud\Model;
 
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
       
    const CACHE_TAG = 'DEMO_CRUD';

        protected function _construct()
        {
                $this->_init('Demo\Crud\Model\ResourceModel\Post');
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