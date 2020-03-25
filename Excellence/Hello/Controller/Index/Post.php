<?php

namespace Excellence\Hello\Controller\Index;

use Magento\Customer\Model\Registration;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;


class Post extends  AbstractAccount implements HttpGetActionInterface, HttpPostActionInterface
{
    public $testFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Excellence\Hello\Model\TestFactory $testFactory,
        Session $customerSession,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        $this->session = $customerSession;
        $this->testFactory = $testFactory;
        $this->resultPageFactory = $resultPageFactory;;
        parent::__construct($context);
    }
    public function execute()
    {
        $post = (array) $this->getRequest()->getPost();

        print_r($post); 

    $test = $this->testFactory->create();
        $test->setTitle($post['email']);
        
        $test->save();
        if ($this->session->isLoggedIn()) {
            /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('*/*/');
            return $resultRedirect;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setHeader('Login-Required', 'true');
        return $resultPage;
        // return $this->resultPageFactory->create();
    }
}