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

	public function sayHello()
	{
	    $test = $this->testFactory->create();
        $data = $test->getCollection();
        return $data->getData();
	}
}