<?php

namespace Demo\Crud\Block;
 
use Magento\Framework\App\Filesystem\DirectoryList;
 
class Index extends \Magento\Framework\View\Element\Template
{
     protected $_filesystem;
 
     public function __construct(
          \Magento\Framework\View\Element\Template\Context $context,
          \Demo\Crud\Model\PostFactory $postFactory
          )
     {
          parent::__construct($context);
          $this->_postFactory = $postFactory;
     }
 
     public function getResult()
     {
          $post = $this->_postFactory->create();
          $collection = $post->getCollection();
          return $collection;
     }
}