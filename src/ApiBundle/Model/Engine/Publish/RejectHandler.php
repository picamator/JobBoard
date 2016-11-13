<?php
namespace ApiBundle\Model\Engine\Publish;

use ApiBundle\Model\Api\Response\ErrorBuilderInterface;
use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Api\Manager\PublisherStatusManagerInterface;
use ApiBundle\Model\Engine\AbstractPublishHandler;

/**
 * Publishing was rejected as a result of reviewing process
 */
class RejectHandler extends AbstractPublishHandler
{
    /**
     * @var string
     */
    private static $errorMessage = 'Your can not publish new job. Your first published job is under moderation. Please wait until you get email with moderation result.';

    /**
     * @var PublisherStatusManagerInterface
     */
    private $publisherStatusManager;

    /**
     * @var ErrorBuilderInterface
     */
    private $errorBuilder;

    /**
     * @param PublisherStatusManagerInterface   $publisherStatusManager
     * @param ErrorBuilderInterface             $errorBuilder
     */
    public function __construct(
        PublisherStatusManagerInterface  $publisherStatusManager,
        ErrorBuilderInterface            $errorBuilder
    ) {
        $this->publisherStatusManager   = $publisherStatusManager;
        $this->errorBuilder             = $errorBuilder;
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

        // another status then awaiting for moderation
        $status = $this->publisherStatusManager->getAwaitingModeration();
        if ($publisher->getPublisherStatusId() !== $status) {
            return null;
        }

        // build error message
        $this->errorBuilder->setCode(200)
            ->setMessage(self::$errorMessage);

        return $this->errorBuilder->build();
    }
}
