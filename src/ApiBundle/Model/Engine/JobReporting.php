<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Engine;

use ApiBundle\Model\Api\Engine\JobReportingInterface;
use ApiBundle\Model\Api\Engine\PublishHandlerInterface;
use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Manager\PublisherManagerInterface;
use ApiBundle\Model\Api\Request\Data\JobPostingInterface;

/**
 * Job Reporting
 */
class JobReporting implements JobReportingInterface
{
    /**
     * @var PublisherManagerInterface
     */
    private $publisherManager;

    /**
     * @var JobPoolInterface
     */
    private $jobPool;

    /**
     * @var PublishHandlerInterface
     */
    private $publishHandler;

    /**
     * @param PublisherManagerInterface $publisherManager
     * @param JobPoolInterface          $jobPool
     * @param PublishHandlerInterface   $publishHandler
     */
    public function __construct(
        PublisherManagerInterface   $publisherManager,
        JobPoolInterface            $jobPool,
        PublishHandlerInterface     $publishHandler
    ) {
        $this->publisherManager = $publisherManager;
        $this->jobPool          = $jobPool;
        $this->publishHandler   = $publishHandler;
    }

    /**
     * {@inheritdoc}
     */
    public function report(JobPostingInterface $jopPosting)
    {
        // publisher
        $publisher = $this->publisherManager->findPublisher($jopPosting->getEmail());

        // job pool
        $this->jobPool
            ->setTitle($jopPosting->getTitle())
            ->setDescription($jopPosting->getDescription());

        return $this->publishHandler->handle($publisher, $this->jobPool);
    }
}
