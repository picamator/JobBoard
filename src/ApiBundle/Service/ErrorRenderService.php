<?php
declare(strict_types = 1);

namespace ApiBundle\Service;

use ApiBundle\Model\Api\Response\Data\ErrorInterface;
use ApiBundle\Service\Controller\Error\BadRequestService;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Error render
 */
class ErrorRenderService
{
    /**
     * @var string
     */
    private static $template = 'Invalid parameter \'%s\'. %s';

    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Error render
     *
     * @param ConstraintViolationListInterface $errorList
     *
     * @return ErrorInterface
     */
    public function render(ConstraintViolationListInterface $errorList) : ErrorInterface
    {
        $renderedList= [];

        /** @var ConstraintViolationInterface $item */
        foreach ($errorList as $item) {
            $renderedList[] = sprintf(self::$template, $item->getPropertyPath(), $item->getMessage());
        }

        $message = implode($renderedList, PHP_EOL);

        /** @var BadRequestService $badRequest */
        $badRequest = $this->container->get('service_controller_error_bad_request');

        return $badRequest->getResponse($message);
    }
}
