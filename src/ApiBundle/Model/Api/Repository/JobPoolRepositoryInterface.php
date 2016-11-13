<?php
namespace ApiBundle\Model\Api\Repository;

use ApiBundle\Model\Api\Entity\JobPoolInterface;

/**
 * Job Pool repository
 */
interface JobPoolRepositoryInterface
{
    /**
     * Find job from the pool
     *
     * @param int $id
     *
     * @return JobPoolInterface | null
     */
    public function findJob(int $id);
}
