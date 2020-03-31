<?php

namespace Excellence\Hello\Controller\Index;

class DisplayData extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    protected $testFactory; 
    protected $registry;
    protected $messageManager;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Excellence\Hello\Model\TestFactory $testFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) 
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->testFactory = $testFactory;
        $this->registry = $registry;
        $this->messageManager = $messageManager;
        
        parent::__construct($context);
    }

    public function execute()
    {
        
        $post = $this->getRequest()->getPostValue();
        if(!empty($post))
        {
            $searchData = $post['search_data'];
            $test = $this->testFactory->create();
            $data = $test->getCollection()->addFieldToSelect(['title', 'test_id', 'creation_time', 'checkout_time'])
             ->addFieldToFilter('title', array('like' => '%'.$searchData.'%')); 
            if(!empty($data->getData()))
            {
                $this->registry->register('data', $data);
            }
            else
            {
                $this->messageManager->addError('No Data Match');
            }
        }  
        else
        { 
            $error = 1;
            $this->registry->register('data', $error);      
        }     
        return $this->resultPageFactory->create();
    }
  
}

