<?php

namespace Admin\Grid\Controller\Adminhtml\Post;

class Save extends \Admin\Grid\Controller\Adminhtml\Post
{
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->_date = $date;
        parent::__construct($context);
    }
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {
            try {
                $model = $this->_objectManager->create('Admin\Grid\Model\Post');
                $data  = $this->getRequest()->getPostValue();
                $inputFilter = new \Zend_Filter_Input(
                    [],
                    [],
                    $data
                );
                $data = $inputFilter->getUnescaped();
                $id = $this->getRequest()->getParam('post_id');
                if ($id) {
                    $model->load($id);
                    if ($id != $model->getPostId()) {
                        throw new \Magento\Framework\Exception\LocalizedException(__('The wrong item is specified.'));
                    }
                }
               
                $model->setName($data['name']);
                $model->setUniversity($data['university']);
                $model->setGender($data['gender']);
    

                if (!$model->getPostId()) {
                    $model->setCreatedAt($this->_date->gmtDate());
                }
                $model->setUpdatedAt($this->_date->gmtDate());
                $session = $this->_objectManager->get('Magento\Backend\Model\Session');
                $session->setPageData($model->getData());
                $model->save();
                $this->messageManager->addSuccess(__('You saved the item.'));
                $session->setPageData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('admingrid/*/edit', ['post_id' => $model->getPostId()]);
                    return;
                }
                $this->_redirect('admingrid/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
                $id = (int)$this->getRequest()->getParam('post_id');
                if (!empty($id)) {
                    $this->_redirect('admingrid/*/edit', ['post_id' => $id]);
                } else {
                    $this->_redirect('admingrid/*/new');
                }
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('Something went wrong while saving the item data. Please review the error log.')
                );
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($data);
                $this->_redirect('admingrid/*/edit', ['post_id' => $this->getRequest()->getParam('post_id')]);
                return;
            }
        }
        $this->_redirect('admingrid/*/');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Admin_Grid::post');
    }
}
