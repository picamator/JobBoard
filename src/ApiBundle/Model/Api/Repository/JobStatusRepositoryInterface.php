<?php
namespace ApiBundle\Model\Api\Repository;

/**
 * Job Status repository
 */
interface JobStatusRepositoryInterface
{
    /**
     * Find status
     *
     * @param string $slug
     *
     * @return JobStatusRepositoryInterface | null
     */
    public function findStatus(string $slug);
}
