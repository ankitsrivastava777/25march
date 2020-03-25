<?php
 
 
namespace Excellence\Hello\Observer;
 
use \Psr\Log\LoggerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
 
 
class Login implements ObserverInterface
{
    
    protected $logger;
    protected $testFactory;

    protected $registry;

   
    public function __construct(LoggerInterface $logger,
    \Excellence\Hello\Model\TestFactory $testFactory,
    \Magento\Framework\Registry $registry
    )
    {
        $this->logger = $logger;
        $this->testFactory = $testFactory;
        $this->registry = $registry;

    }
 
    public function execute(Observer $observer)
    {
        
       
        $customer = $observer->getModel();
      
        $test = $this->testFactory->create();
        $test->setTitle($customer['email']);
        $test->setCheckoutTime(NULL);
        $test->setTestId($customer['entity_id']);
       
         $test->save();

    

     }
}
