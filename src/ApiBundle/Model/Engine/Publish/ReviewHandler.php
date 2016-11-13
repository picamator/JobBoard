<?php
namespace ApiBundle\Model\Engine\Publish;

use ApiBundle\Model\Api\Command\TaskInterface;
use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Api\Manager\JobPoolManagerInterface;
use ApiBundle\Model\Api\Manager\PublisherStatusManagerInterface;
use ApiBundle\Model\Api\Response\ErrorBuilderInterface;
use ApiBundle\Model\Engine\AbstractPublishHandler;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Publisher was used app for the first time or their job was marked as a spam
 */
class ReviewHandler extends AbstractPublishHandler
{
    /**
     * @var string
     */
    private static $errorMessage = 'Thank you for using our application. As it is your first posting, your job was sent for moderation. Please wait for email with moderation result.';

    /**
     * @var string
     */
    private static $taskEmailPublisher = 'publisher_email_awaiting_moderation';

    /**
     * @var string
     */
    private static $taskEmailModerator = 'moderator_email_awaiting_moderation';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var PublisherStatusManagerInterface
     */
    private $publisherStatusManager;

    /**
     * @var JobPoolManagerInterface
     */
    private $jobPoolManager;

    /**
     * @var TaskInterface
     */
    private $task;

    /**
     * @var ErrorBuilderInterface
     */
    private $errorBuilder;

    /**
     * @param EntityManagerInterface            $entityManager
     * @param PublisherStatusManagerInterface   $publisherStatusManager
     * @param JobPoolManagerInterface           $jobPoolManager
     * @param TaskInterface                     $task
     * @param ErrorBuilderInterface             $errorBuilder
     */
    public function __construct(
        EntityManagerInterface              $entityManager,
        PublisherStatusManagerInterface     $publisherStatusManager,
        JobPoolManagerInterface             $jobPoolManager,
        TaskInterface                       $task,
        ErrorBuilderInterface               $errorBuilder
    ) {
        $this->entityManager            = $entityManager;
        $this->publisherStatusManager   = $publisherStatusManager;
        $this->jobPoolManager           = $jobPoolManager;
        $this->task                     = $task;
        $this->errorBuilder             = $errorBuilder;
    }

    /**
     * {@inheritdoc}
     */
    protected function process(PublisherInterface $publisher, JobPoolInterface $jobPool)
    {
        // neither new
        if (!$publisher->getId()) {
            return null;
        }

        // neither inactive
        $status = $this->publisherStatusManager->getInactive();
        if ($publisher->getPublisherStatusId() !== $status) {
            return null;
        }

        /** @var JobPoolInterface $jobPool */
        $jobPool = $this->entityManager->transactional(function() use ($publisher, $jobPool) {
            return $this->jobPoolManager->saveForReview($publisher, $jobPool);
        });

        // add tasks
        $this->task
            ->addTask(self::$taskEmailPublisher, $jobPool->getId())
            ->addTask(self::$taskEmailModerator, $jobPool->getId());

        // build error message
        $this->errorBuilder->setCode(200)
            ->setMessage(self::$errorMessage);

        return $this->errorBuilder->build();
    }
}
