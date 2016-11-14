<?php
namespace ApiBundle\Model\Api\Request;

use ApiBundle\Model\Api\Request\Data\PaginationInterface;

/**
 * Create Pagination
 */
interface PaginationFactoryInterface
{
    /**
     * Create
     *
     * @param int | string $startAt
     * @param int | string $maxPerPage
     *
     * @return PaginationInterface
     */
    public function create($startAt, $maxPerPage) : PaginationInterface;
}
