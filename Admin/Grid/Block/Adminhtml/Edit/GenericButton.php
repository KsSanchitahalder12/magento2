<?php

namespace Admin\Grid\Block\Adminhtml\Edit;

use Magento\CatalogRule\Controller\RegistryConstants;

class GenericButton
{
    protected $urlBuilder;

    protected $registry;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

   
    public function getEntityId()
    {
        $catalogRule = $this->registry->registry(RegistryConstants::CURRENT_ADMINGRID);
        return $catalogRule ? $catalogRule->getId() : null;
    }

  
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

    public function canRender($name)
    {
        return $name;
    }
}
