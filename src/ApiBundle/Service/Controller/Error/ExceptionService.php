<?php
declare(strict_types = 1);

namespace ApiBundle\Service\Controller\Error;

use ApiBundle\Model\Api\Command\TaskInterface;
use ApiBundle\Model\Api\Response\Data\ErrorInterface;
use ApiBundle\Model\Api\Response\ErrorBuilderInterface;

/**
 * Exception service
 */
class ExceptionService
{
    /**
     * @var string
     */
    private static $taskError = 'application_error';

    /**
     * @var string
     */
    private static $message = '500 Internal Server Error';

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
        TaskInterface           $task,
        ErrorBuilderInterface   $errorBuilder
    ) {
        $this->task         = $task;
        $this->errorBuilder = $errorBuilder;
    }

    /**
     * Show error messages
     *
     * @param \Exception $exception
     *
     * @return ErrorInterface
     */
    public function getResponse(\Exception $exception) : ErrorInterface
    {
        // task
        $taskMessage  = [
            'code'      =>  $exception->getCode(),
            'message'   =>  $exception->getMessage(),
            'trace'     =>  $exception->getTraceAsString(),
            'line'      =>  $exception->getLine(),
            'file'      =>  $exception->getFile(),
        ];

        $this->task->addTask(self::$taskError, json_encode($taskMessage));

        // response
        $response = $this->errorBuilder->setCode(500)
            ->setMessage(self::$message)
            ->build();

        return $response;
    }
}
