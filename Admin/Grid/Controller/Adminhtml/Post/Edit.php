<?php

namespace Admin\Grid\Controller\Adminhtml\Post;

class Edit extends \Admin\Grid\Controller\Adminhtml\Post
{
    protected $_coreRegistry;
    protected $_resultPageFactory;

   
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('post_id');
        
        $model = $this->_objectManager->create('Admin\Grid\Model\Post');

        if ($id) {
            $model->load($id);
            if (!$model->getPostId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('admingrid/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->_coreRegistry->register('current_admingrid', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('item_edit');
        $this->_view->renderLayout();
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Admin_Grid::item');
    }
}
