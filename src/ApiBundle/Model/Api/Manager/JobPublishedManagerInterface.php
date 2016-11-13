<?php
namespace ApiBundle\Model\Api\Manager;

use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\JobPublishedInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Exception\RuntimeException;

/**
 * Job Published manager
 */
interface JobPublishedManagerInterface
{
    /**
     * Reviewed publish
     *
     * @param PublisherInterface $publisher
     * @param JobPoolInterface   $jobPool
     *
     * @return JobPublishedInterface
     *
     * @throws RuntimeException
     */
    public function reviewedPublish(PublisherInterface $publisher, JobPoolInterface $jobPool) : JobPublishedInterface;

    /**
     * Auto publish
     *
     * @param PublisherInterface $publisher
     * @param JobPoolInterface   $jobPool
     *
     * @return JobPublishedInterface
     *
     * @throws RuntimeException
     */
    public function autoPublish(PublisherInterface $publisher, JobPoolInterface $jobPool) : JobPublishedInterface;
}
