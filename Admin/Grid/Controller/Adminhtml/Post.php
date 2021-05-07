<?php

namespace Admin\Grid\Controller\Adminhtml;

abstract class Post extends \Magento\Backend\App\Action
{
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('admingrid::item')->_addBreadcrumb(__('Post'), __('Post'));
        return $this;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Admin_Grid::post');
    }
}
