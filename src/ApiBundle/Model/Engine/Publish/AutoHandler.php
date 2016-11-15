<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Engine\Publish;

use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Api\Manager\JobPublishedManagerInterface;
use ApiBundle\Model\Api\Manager\PublisherStatusManagerInterface;
use ApiBundle\Model\Api\Response\JobFactoryInterface;
use ApiBundle\Model\Api\Response\JobSeparatedFactoryInterface;
use ApiBundle\Model\Engine\AbstractPublishHandler;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Auto publish handler, case when publisher was activated and all posting go without publication
 */
class AutoHandler extends AbstractPublishHandler
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
     * @var JobPublishedManagerInterface
     */
    private $jobPublishedManager;

    /**
     * @var JobFactoryInterface
     */
    private $jobFactory;

    /**
     * @var JobSeparatedFactoryInterface
     */
    private $jobSeparatedFactory;

    /**
     * @param EntityManagerInterface            $entityManager
     * @param PublisherStatusManagerInterface   $publisherStatusManager
     * @param JobPublishedManagerInterface      $jobPublishedManager
     * @param JobFactoryInterface               $jobFactory
     * @param JobSeparatedFactoryInterface      $jobSeparatedFactory
     */
    public function __construct(
       EntityManagerInterface           $entityManager,
       PublisherStatusManagerInterface  $publisherStatusManager,
       JobPublishedManagerInterface     $jobPublishedManager,
       JobFactoryInterface              $jobFactory,
       JobSeparatedFactoryInterface     $jobSeparatedFactory
    ) {
        $this->entityManager            = $entityManager;
        $this->publisherStatusManager   = $publisherStatusManager;
        $this->jobPublishedManager      = $jobPublishedManager;
        $this->jobFactory               = $jobFactory;
        $this->jobSeparatedFactory      = $jobSeparatedFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function process(PublisherInterface $publisher, JobPoolInterface $jobPool)
    {
        // new publisher
        if (!$publisher->getId()) {
            return null;
        }

        // inactive publisher
        $status = $this->publisherStatusManager->getActive();
        if ($publisher->getPublisherStatus()->getId() !== $status->getId()) {
            return null;
        }

        // provide auto publishing
        $this->entityManager->transactional(function() use ($publisher, $jobPool, &$jobPublished) {
            $jobPublished = $this->jobPublishedManager->autoPublish($publisher, $jobPool);
        });

        // it is critical to get createdAt
        // all date are generated on MySQL server therefore to keep consistence generation of that date also kept on database server
        $this->entityManager->refresh($jobPublished);
        $job = $this->jobFactory->create($jobPublished);

        return $this->jobSeparatedFactory->create($job);
    }
}
