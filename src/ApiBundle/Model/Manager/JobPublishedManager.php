<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Manager;

use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\JobPublishedInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Api\Manager\JobPublishedManagerInterface;
use ApiBundle\Model\Api\Manager\JobStatusManagerInterface;
use ApiBundle\Model\Api\ObjectManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use ApiBundle\Model\Exception\RuntimeException;

/**
 * Job Published manager
 */
class JobPublishedManager implements JobPublishedManagerInterface
{
    /**
     * @var string
     */
    private static $entityType = 'ApiBundle\Model\Api\Entity\JobPublishedInterface';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var JobStatusManagerInterface
     */
    private $jobStatusManager;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @param EntityManagerInterface    $entityManager
     * @param JobStatusManagerInterface $jobStatusManager,
     * @param ObjectManagerInterface    $objectManager
     * @param string                    $entityName
     */
    public function __construct(
        EntityManagerInterface       $entityManager,
        JobStatusManagerInterface    $jobStatusManager,
        ObjectManagerInterface       $objectManager,
        string                       $entityName = 'ApiBundle\Entity\JobPublished'
    ) {
        $this->entityManager        = $entityManager;
        $this->jobStatusManager     = $jobStatusManager;
        $this->objectManager        = $objectManager;
        $this->entityName           = $entityName;
    }

    /**
     * {@inheritdoc}
     */
    public function reviewedPublish(PublisherInterface $publisher, JobPoolInterface $jobPool)
    {
        // job pool
        $activeStatus = $this->jobStatusManager->getPublished();
        $jobPool->setJobStatus($activeStatus)
            ->setPublisher($publisher);

        $this->entityManager->persist($jobPool);

        // job published
        $jobPublished = $this->getJobPublished($publisher, $jobPool);
        $jobPublished->setJobPool($jobPool);

        $this->entityManager->persist($jobPublished);
    }

    /**
     * {@inheritdoc}
     */
    public function autoPublish(PublisherInterface $publisher, JobPoolInterface $jobPool)
    {
        // job pool
        $activeStatus = $this->jobStatusManager->getPublished();
        $jobPool->setJobStatus($activeStatus)
            ->setPublisher($publisher);

        $this->entityManager->persist($jobPool);

        // job publisher
        $jobPublished = $this->getJobPublished($publisher, $jobPool);
        $jobPublished->setJobPool($jobPool);

        $this->entityManager->persist($jobPublished);

        return $jobPublished;
    }

    /**
     * Get job published
     *
     * @param PublisherInterface    $publisher
     * @param JobPoolInterface      $jobPool
     *
     * @return JobPublishedInterface
     *
     * @throws RuntimeException
     */
    private function getJobPublished(PublisherInterface $publisher, JobPoolInterface $jobPool) : JobPublishedInterface
    {
        $jobPublished = $this->objectManager->create($this->entityName);
        if (!is_a($jobPublished, self::$entityType)) {
            throw new RuntimeException(
                sprintf('Invalid entity "%s". It is only accepted "%s".', $this->entityName, self::$entityType)
            );
        };

        $jobPublished->setTitle($jobPool->getTitle())
            ->setDescription($jobPool->getDescription())
            ->setEmail($publisher->getEmail());

        return $jobPublished;
    }
}
