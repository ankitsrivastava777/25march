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
        protected $session;
        protected $formKey;

    public function __construct(    
        LoggerInterface $logger,
        \Excellence\Hello\Model\TestFactory $testFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
        \Magento\Framework\Session\SessionManager $session,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Integration\Model\Oauth\TokenFactory $tokenModelFactory,
        \Magento\Framework\Data\Form\FormKey $formKey
    )

    {
        $this->logger = $logger;
        $this->testFactory = $testFactory;
        $this->registry = $registry;
        $this->date = $date;
        $this->session = $session;
        $this->customerSession = $customerSession;
        $this->_tokenModelFactory = $tokenModelFactory;
        $this->formKey = $formKey;

    }
    
    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $time = $this->date->date()->format('Y-m-d H:i:s');     
        $test = $this->testFactory->create();
        $test->setTitle($customer['email']);
        $test->setCreationTime('');
        $test->setIsActive($customer['entity_id']);
        $test->setCheckoutTime(NULL);        
        $test->save();         
    }
}
