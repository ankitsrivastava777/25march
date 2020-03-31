<?php

namespace Excellence\Hello\Observer;

use Magento\Customer\Model\Logger;
use Magento\Framework\Stdlib\DateTime;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;


class Logout implements ObserverInterface
{
    protected $logger;
    protected $testFactory;
    protected $registry;
    protected $date;
    protected $productFactory;
    protected $session;
    protected $customerSession;
    protected $formKey;

    public function __construct(Logger $logger,
      \Excellence\Hello\Model\TestFactory $testFactory,
      \Magento\Framework\Registry $registry,
      \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
      \Excellence\Hello\Model\ResourceModel\Test\CollectionFactory $productFactory,
      \Magento\Framework\Session\SessionManager $session,
      \Magento\Integration\Model\Oauth\TokenFactory $tokenModelFactory,
      \Magento\Customer\Model\Session $customerSession,
      \Magento\Framework\Data\Form\FormKey $formKey
    )

    {
        $this->logger = $logger;
        $this->testFactory = $testFactory;
        $this->registry = $registry;
        $this->date = $date;
        $this->productFactory = $productFactory;
        $this->session = $session;
        $this->_tokenModelFactory = $tokenModelFactory;
        $this->customerSession = $customerSession;
        $this->formKey = $formKey;
    }

    public function execute(Observer $observer)
    {
      $customerId = $this->customerSession->getCustomer()->getId();
      $customerToken = $this->_tokenModelFactory->create();
      $tokenKey = $customerToken->createCustomerToken($customerId)->getToken();
      $id = $observer->getEvent()->getCustomer(); 
      $time = $this->date->date()->format('Y-m-d H:i:s');
      $test = $this->testFactory->create();
      $data = $test->getCollection()->addFieldToFilter('session',"")->setOrder('test_id', 'ASC')->setPageSize(1)->getData();

      foreach($data as $row)
      {
       if($row['checkout_time'] == NULL)
        $test->load($row['test_id']);
        $test->setCheckoutTime($time);
        $test->setSession($tokenKey);
        $test->save();
      }
    }    
}


