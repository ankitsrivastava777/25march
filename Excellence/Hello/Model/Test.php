<?php
namespace Excellence\Hello\Model;

/**
 * Class Test
 */
class Test extends \Magento\Framework\Model\AbstractModel implements
    \Excellence\Hello\Api\Data\TestInterface,
    \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'excellence_hello_test';

    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(\Excellence\Hello\Model\ResourceModel\Test::class);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
