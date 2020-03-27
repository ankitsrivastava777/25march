<?php

namespace Excellence\Hello\Block\Index;

class Display extends \Magento\Framework\View\Element\Template
{
    protected $testFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Excellence\Hello\Model\TestFactory $testFactory
    )
	{
        parent::__construct($context);
        $this->testFactory = $testFactory;
	}

	public function getUserData()
	{
	    $test = $this->testFactory->create();
        $collection = $test->getCollection();
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        //get values of current limit. if not the param value then it will set to 1
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5;
        $collection = $this->testFactory->create();
        $collection = $collection->getCollection();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;    
    }
    public function _prepareLayout()
    {
        parent::_prepareLayout(); 
        $this->pageConfig->getTitle()->set(__('Customer Log Records'));
        
        if ($this->getUserData())
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