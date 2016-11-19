<?php
namespace ApiBundle\Model\Api\Request\Data;

/**
 * Pagination value object
 */
interface PaginationInterface
{
    /**
     * Get start at
     *
     * @return int
     */
    public function getStartAt() : int;

    /**
     * Get max per page
     *
     * @return int
     */
    public function getMaxPerPage() : int;
}
