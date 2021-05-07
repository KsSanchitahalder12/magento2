<?php


namespace Admin\Grid\Controller\Adminhtml\Post;

class NewAction extends \Admin\Grid\Controller\Adminhtml\Post
{
    public function execute()
    {
        $this->_forward('edit');
    }
}
