<?php
namespace ApiBundle\Model\Api\Manager;

use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;

/**
 * Job Pool manager
 */
interface JobPoolManagerInterface
{
    /**
     * Save for review
     *
     * @param PublisherInterface    $publisher
     * @param JobPoolInterface      $jobPool
     *
     * @return JobPoolInterface
     */
    public function saveForReview(PublisherInterface $publisher, JobPoolInterface $jobPool) : JobPoolInterface;
}
