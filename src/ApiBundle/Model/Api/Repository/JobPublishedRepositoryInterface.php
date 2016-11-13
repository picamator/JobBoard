<?php
namespace ApiBundle\Model\Api\Repository;

use ApiBundle\Model\Exception\InvalidArgumentException;

/**
 * Job Published repository
 */
interface JobPublishedRepositoryInterface
{
    /**
     * Find page
     *
     * @param int $maxPerPage
     * @param int $startAt
     *
     * @return array
     *
     * @throws InvalidArgumentException
     */
    public function findPage(int $maxPerPage, int $startAt) : array;

    /**
     * Get total
     *
     * @return int
     */
    public function getTotal() : int;
}
