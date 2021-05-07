<?php

namespace Admin\Grid\Model\Post;

use Admin\Grid\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        $name,
        DataPersistorInterface $DataPersistorInterface,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $CollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->dataPersistor=$DataPersistorInterface;
        $this->collection = $CollectionFactory->create();
        $this->_request = $request;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
 
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $item->load($item->getId());
            $this->loadedData[$item->getId()] = $item->getData();
        }
        
        $data = $this->dataPersistor->get('Grid_post');
            
        if (!empty($data)) {
            $item = $this->collection->getNewEmptyItem();
            $item->setData($item);
            $this->loadedData[$item->getId()] = $item->getData();
            $this->dataPersistor->clear('Grid_post');
        }
        return $this->loadedData;
    }
}
