<?php

namespace Admin\Grid\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Admin\Grid\Model\ResourceModel\Post\CollectionFactory as ItemCollection;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $filter;
    protected $_itemCollectionFactory;

    
    public function __construct(
        Context $context,
        Filter $filter,
        ItemCollection $itemCollectionFactory
    ) {
        $this->filter = $filter;
        $this->_itemCollectionFactory = $itemCollectionFactory;
        parent::__construct($context);
    }

    
    public function execute()
    {
        $collection = $this->filter->getCollection($this->_itemCollectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $record) {
            $record->delete();
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collectionSize));

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('admingrid/*/');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Admin_Grid::item');
    }
}
