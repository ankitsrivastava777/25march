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
        $collection = $this->testFactory->create();
        $collection = $collection->getCollection();
        return $collection;    
    }
    public function getSearchData()
	{
        $data = $this->registry->registry('data');
        $errorMessage = $this->registry->registry('message');
        if(!empty($data))
        {
            if($data === 1)
            {
                return 1;
            }
            else
            {
                return $data;
            }
        }         
    }
}