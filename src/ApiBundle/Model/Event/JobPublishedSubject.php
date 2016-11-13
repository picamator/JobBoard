<?php
namespace ApiBundle\Model\Event;

use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\JobPublishedInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Api\Event\SubjectInterface;
use ApiBundle\Model\Api\Manager\JobPublishedManagerInterface;
use Doctrine\ORM\EntityManager;

/**
 * Job Published subject
 */
class JobPublishedSubject implements JobPublishedManagerInterface, SubjectInterface
{
    use SubjectTrait;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var JobPublishedManagerInterface
     */
    private $jobPublishedManager;

    /**
     * @param EntityManager                   $entityManager,
     * @param JobPublishedManagerInterface    $jobPublishedManager
     */
    public function __construct(
        EntityManager                   $entityManager,
        JobPublishedManagerInterface    $jobPublishedManager
    ) {
        $this->entityManager        = $entityManager;
        $this->jobPublishedManager  = $jobPublishedManager;
    }

    /**
     * {@inheritdoc}
     *
     * @events beforeReviewedPublish, afterReviewedPublish
     */
    public function reviewedPublish(PublisherInterface $publisher, JobPoolInterface $jobPool) : JobPublishedInterface
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
    public function autoPublish(PublisherInterface $publisher, JobPoolInterface $jobPool)  : JobPublishedInterface
    {
        $this->notify('beforeAutoPublish', $publisher, $jobPool);
        $jobPublished = $this->jobPublishedManager->autoPublish($publisher, $jobPool);
        $this->notify('afterAutoPublish', $jobPublished);

        return $jobPublished;
    }
}
