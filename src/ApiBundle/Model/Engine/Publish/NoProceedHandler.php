<?php
namespace ApiBundle\Model\Engine\Publish;

use ApiBundle\Model\Api\Response\ErrorBuilderInterface;
use ApiBundle\Model\Api\Command\TaskInterface;
use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Engine\AbstractPublishHandler;

/**
 * Publishing con not be proceeded
 */
class NoProceedHandler extends AbstractPublishHandler
{
    /**
     * @var string
     */
    private static $errorMessage = 'Job can not be published. Application fails to proceed publication process. Please try again later or contact to administrator.';

    /**
     * @var string
     */
    private static $taskError = 'application_error';

    /**
     * @var TaskInterface
     */
    private $task;

    /**
     * @var ErrorBuilderInterface
     */
    private $errorBuilder;

    /**
     * @param TaskInterface         $task
     * @param ErrorBuilderInterface $errorBuilder
     */
    public function __construct(
        TaskInterface         $task,
        ErrorBuilderInterface $errorBuilder
    ) {
        $this->task          = $task;
        $this->errorBuilder  = $errorBuilder;
    }

    /**
     * {@inheritdoc}
     */
    protected function process(PublisherInterface $publisher, JobPoolInterface $jobPool)
    {
        // send task
        $message = [
            'publisher' => $publisher->getEmail(),
            'jobPoolId' => $jobPool->getId()
        ];
        $this->task->addTask(self::$taskError, json_encode($message));

        // build error message
        $this->errorBuilder->setCode(500)
            ->setMessage(self::$errorMessage);

        return $this->errorBuilder->build();
    }
}
