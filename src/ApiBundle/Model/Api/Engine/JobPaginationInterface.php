<?php
namespace ApiBundle\Model\Api\Engine;

use ApiBundle\Model\Api\Request\Data\PaginationInterface;
use ApiBundle\Model\Api\Response\Data\JobCollectionInterface;

/**
 * Job pagination
 */
interface JobPaginationInterface
{
    /**
     * Gets page
     *
     * @param PaginationInterface $pagination
     *
     * @return JobCollectionInterface
     */
    public function getPage(PaginationInterface $pagination) : JobCollectionInterface;
}
