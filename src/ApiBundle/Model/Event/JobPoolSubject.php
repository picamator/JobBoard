<?php
namespace ApiBundle\Model\Event;

use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Api\Event\SubjectInterface;
use ApiBundle\Model\Api\Manager\JobPoolManagerInterface;

/**
 * Job Pool subject
 *
 * @codeCoverageIgnore
 */
class JobPoolSubject implements JobPoolManagerInterface, SubjectInterface
{
    use SubjectTrait;

    /**
     * @var JobPoolManagerInterface
     */
    private $jobPoolManager;

    /**
     * @param JobPoolManagerInterface $jobPoolManager
     */
    public function __construct(
        JobPoolManagerInterface $jobPoolManager
    ) {
        $this->jobPoolManager = $jobPoolManager;
    }

    /**
     * {@inheritdoc}
     *
     * @events beforeSaveForReview, afterSaveForReview
     */
    public function saveForReview(PublisherInterface $publisher, JobPoolInterface $jobPool)
    {
        $this->notify('beforeSaveForReview', $publisher, $jobPool);
        $this->jobPoolManager->saveForReview($publisher, $jobPool);
        $this->notify('afterSaveForReview', $jobPool);
    }
}
