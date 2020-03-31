<?php

namespace Excellence\Hello\Block\Index;

class Display extends \Magento\Framework\View\Element\Template
{
    protected $testFactory;
    protected $registry;
    

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Excellence\Hello\Model\TestFactory $testFactory,
        \Magento\Framework\Registry $registry
    )
	{
        parent::__construct($context);
        $this->testFactory = $testFactory;
        $this->registry = $registry;
	}

	public function getUserData()
	{   
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5;
        $collection = $this->testFactory->create();
        $collection = $collection->getCollection();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;    
    }
    public function getSearchData()
	{
        $data = $this->registry->registry('data');
        if(!empty($data))
        {
            $data = $this->registry->registry('data');
            return $data;
        }
    }

    public function _prepareLayout()
    {
        parent::_prepareLayout(); 
        $this->pageConfig->getTitle()->set(__('Customer Log Records'));
    
        if($this->getUserData())
        {
            $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'fme.news.pager'
            )->setAvailableLimit(array(5 => 5   , 10 => 10, 15 => 15))->setShowPerPage(true)->setCollection(
            $this->getUserData()
            );
            $this->setChild('pager', $pager);
            $this->getUserData()->load();  
        }
            return $this;  
        
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}