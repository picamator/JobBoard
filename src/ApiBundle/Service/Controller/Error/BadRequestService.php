<?php
declare(strict_types = 1);

namespace ApiBundle\Service\Controller\Error;

use ApiBundle\Model\Api\Response\Data\ErrorInterface;
use ApiBundle\Model\Api\Response\ErrorBuilderInterface;

/**
 * Bad request service
 */
class BadRequestService
{
    /**
     * @var string
     */
    private static $defaultMessage = '400 Bad Request';

    /**
     * @var ErrorBuilderInterface
     */
    private $errorBuilder;

    /**
     * @param ErrorBuilderInterface $errorBuilder
     */
    public function __construct(ErrorBuilderInterface   $errorBuilder)
    {
        $this->errorBuilder = $errorBuilder;
    }

    /**
     * Get error messages
     *
     * @param string | null $message
     *
     * @return ErrorInterface
     */
    public function getResponse(string $message = null) : ErrorInterface
    {
        $message = $message ?? self::$defaultMessage;
        $response = $this->errorBuilder->setCode(400)
            ->setMessage($message)
            ->build();

        return $response;
    }
}
