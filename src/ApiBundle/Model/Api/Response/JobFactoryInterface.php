<?php
namespace ApiBundle\Model\Api\Response;

use ApiBundle\Model\Api\Response\Data\JobInterface;
use ApiBundle\Model\Api\Entity\JobPublishedInterface;

/**
 * Job factory
 */
interface JobFactoryInterface
{
    /**
     * Create
     *
     * @param JobPublishedInterface $jobPublished
     *
     * @return JobInterface
     */
    public function create(JobPublishedInterface $jobPublished) : JobInterface;
}
