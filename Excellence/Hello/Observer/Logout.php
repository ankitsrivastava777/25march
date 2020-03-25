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

    
    public function __construct(Logger $logger,
    \Excellence\Hello\Model\TestFactory $testFactory,
    \Magento\Framework\Registry $registry,
    \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date

    
    )
    {
        $this->logger = $logger;
        $this->testFactory = $testFactory;
        $this->registry = $registry;
        $this->date = $date;

    }

    public function execute(Observer $observer)
    {
        
   
       $id = $observer->getEvent()->getCustomer()->getId();
       

   
$time = $this->date->date()->format('Y-m-d H:i:s');

   
       $test = $this->testFactory->create();
   

  
       if($test['checkout_time'] == NULL)
       {
        $test->load($id);
        $test->setCheckoutTime($time);
        $test->save();
       }
     
     }

    }

