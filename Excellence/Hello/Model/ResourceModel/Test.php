<?php
namespace Excellence\Hello\Model\ResourceModel;

/**
 * Class Test
 */
class Test extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init('excellence_hello_test', 'test_id');
    }
}
