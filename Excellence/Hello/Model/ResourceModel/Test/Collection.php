<?php
namespace Excellence\Hello\Model\ResourceModel\Test;

/**
 * Class Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(\Excellence\Hello\Model\Test::class, \Excellence\Hello\Model\ResourceModel\Test::class);
    }
}
