<?php
namespace ApiBundle\Model\Api\Repository;

/**
 * Job Published repository
 */
interface JobPublishedRepositoryInterface
{
    /**
     * Find page
     *
     * @param int $startAt
     * @param int $maxPerPage
     *
     * @return array
     */
    public function findPage(int $startAt, int $maxPerPage) : array;

    /**
     * Get total
     *
     * @return int
     */
    public function getTotal() : int;
}
