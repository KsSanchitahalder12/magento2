<?php

namespace Demo\Crud\Controller\Index;
 
use Magento\Framework\App\Filesystem\DirectoryList;
 
class Save extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $_postFactory;
     protected $_filesystem;
 
     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Demo\Crud\Model\PostFactory $postFactory,
          \Magento\Framework\Filesystem $filesystem
          )
     {
          $this->_pageFactory = $pageFactory;
          $this->_postFactory = $postFactory;
          $this->_filesystem = $filesystem;
          return parent::__construct($context);
     }
 
     public function execute()
     {
          if ($this->getRequest()->isPost()) {
               $input = $this->getRequest()->getPostValue();
               $post = $this->_postFactory->create();
 
          if($input['id']){
                    $post->load($input['id']);
                    $post->addData($input);
                    $post->setId($input['id']);
                    $post->save();
          }else{
               $post->setData($input)->save();
          }
 
              return $this->_redirect('crud/index/index');
          }
     }
}