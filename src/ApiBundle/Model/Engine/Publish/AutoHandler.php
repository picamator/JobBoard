<?php
namespace ApiBundle\Model\Engine\Publish;

use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Api\Manager\JobPublishedManagerInterface;
use ApiBundle\Model\Api\Manager\PublisherStatusManagerInterface;
use ApiBundle\Model\Api\Response\CollectionFactoryInterface;
use ApiBundle\Model\Api\Response\JobFactoryInterface;
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
     * @var CollectionFactoryInterface
     */
    private $collectionFactory;

    /**
     * @param EntityManagerInterface            $entityManager
     * @param PublisherStatusManagerInterface   $publisherStatusManager
     * @param JobPublishedManagerInterface      $jobPublishedManager
     * @param JobFactoryInterface               $jobFactory
     * @param CollectionFactoryInterface        $collectionFactory
     */
    public function __construct(
       EntityManagerInterface           $entityManager,
       PublisherStatusManagerInterface  $publisherStatusManager,
       JobPublishedManagerInterface     $jobPublishedManager,
       JobFactoryInterface              $jobFactory,
       CollectionFactoryInterface       $collectionFactory
    ) {
        $this->entityManager            = $entityManager;
        $this->publisherStatusManager   = $publisherStatusManager;
        $this->jobPublishedManager      = $jobPublishedManager;
        $this->jobFactory               = $jobFactory;
        $this->collectionFactory        = $collectionFactory;
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
        if ($publisher->getPublisherStatusId() !== $status) {
            return null;
        }

        // provide auto publishing
        $jobPublished = $this->entityManager->transactional(function() use ($publisher, $jobPool) {
            return $this->jobPublishedManager->autoPublish($publisher, $jobPool);
        });

        $job = $this->jobFactory->create($jobPublished);

        return $this->collectionFactory->create('ApiBundle\Model\Api\Response\Data\JobInterface', [$job]);
    }
}
