<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Manager;

use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Api\Manager\JobPoolManagerInterface;
use ApiBundle\Model\Api\Manager\JobStatusManagerInterface;
use ApiBundle\Model\Api\Manager\PublisherStatusManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Job Pool manager
 */
class JobPoolManager implements JobPoolManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var PublisherStatusManagerInterface
     */
    private $publisherStatusManager;

    /**
     * @var JobStatusManagerInterface
     */
    private $jobStatusManager;

    /**
     * @param EntityManagerInterface            $entityManager
     * @param PublisherStatusManagerInterface   $publisherStatusManager
     * @param JobStatusManagerInterface         $jobStatusManager
     */
    public function __construct(
      EntityManagerInterface            $entityManager,
      PublisherStatusManagerInterface   $publisherStatusManager,
      JobStatusManagerInterface         $jobStatusManager
    ) {
        $this->entityManager            = $entityManager;
        $this->publisherStatusManager   = $publisherStatusManager;
        $this->jobStatusManager         = $jobStatusManager;
    }

    /**
     * {@inheritdoc}
     */
    public function saveForReview(PublisherInterface $publisher, JobPoolInterface $jobPool)
    {
        // publisher
        $publisherStatus = $this->publisherStatusManager->getAwaitingModeration();
        $publisher->setPublisherStatus($publisherStatus);

        $this->entityManager->persist($publisher);

        // job pool
        $jobPoolStatus = $this->jobStatusManager->getForReview();
        $jobPool->setJobStatus($jobPoolStatus)
            ->setPublisher($publisher);

        $this->entityManager->persist($jobPool);
    }
}
