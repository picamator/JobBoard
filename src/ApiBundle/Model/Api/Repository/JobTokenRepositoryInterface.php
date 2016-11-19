<?php
namespace ApiBundle\Model\Api\Repository;

use ApiBundle\Model\Api\Entity\JobTokenInterface;

/**
 * Job Token repository
 */
interface JobTokenRepositoryInterface
{
    /**
     * Find token
     *
     * @param int $jobPoolId
     *
     * @return JobTokenInterface | null
     */
    public function findToken(int $jobPoolId);
}
