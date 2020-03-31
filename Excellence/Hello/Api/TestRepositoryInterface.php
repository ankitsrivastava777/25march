<?php
namespace Excellence\Hello\Api;

use Excellence\Hello\Api\Data\TestInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface TestRepositoryInterface
 *
 * @api
 */
interface TestRepositoryInterface
{
    /**
     * Create or update a Test.
     *
     * @param TestInterface $page
     * @return TestInterface
     */
    public function save(TestInterface $page);

    /**
     * Get a Test by Id
     *
     * @param int $id
     * @return TestInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If Test with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve Tests which match a specified criteria.
     *
     * @param SearchCriteriaInterface $criteria
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * Delete a Test
     *
     * @param TestInterface $page
     * @return TestInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If Test with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(TestInterface $page);

    /**
     * Delete a Test by Id
     *
     * @param int $id
     * @return TestInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If customer with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}
