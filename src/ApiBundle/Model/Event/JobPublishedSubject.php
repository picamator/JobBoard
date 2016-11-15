<?php
namespace ApiBundle\Model\Event;

use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\JobPublishedInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Api\Event\SubjectInterface;
use ApiBundle\Model\Api\Manager\JobPublishedManagerInterface;

/**
 * Job Published subject
 *
 * @codeCoverageIgnore
 */
class JobPublishedSubject implements JobPublishedManagerInterface, SubjectInterface
{
    use SubjectTrait;

    /**
     * @var JobPublishedManagerInterface
     */
    private $jobPublishedManager;

    /**
     * @param JobPublishedManagerInterface    $jobPublishedManager
     */
    public function __construct(JobPublishedManagerInterface $jobPublishedManager)
    {
        $this->jobPublishedManager = $jobPublishedManager;
    }

    /**
     * {@inheritdoc}
     *
     * @events beforeReviewedPublish, afterReviewedPublish
     */
    public function reviewedPublish(PublisherInterface $publisher, JobPoolInterface $jobPool)
    {
        $this->notify('beforeReviewedPublish', $publisher, $jobPool);
        $jobPublished = $this->jobPublishedManager->reviewedPublish($publisher, $jobPool);
        $this->notify('afterReviewedPublish', $jobPublished);

        return $jobPublished;
    }

    /**
     * {@inheritdoc}
     *
     * @events beforeAutoPublish, afterAutoPublish
     */
    public function autoPublish(PublisherInterface $publisher, JobPoolInterface $jobPool)
    {
        $this->notify('beforeAutoPublish', $publisher, $jobPool);
        $jobPublished = $this->jobPublishedManager->autoPublish($publisher, $jobPool);
        $this->notify('afterAutoPublish', $jobPublished);

        return $jobPublished;
    }
}
