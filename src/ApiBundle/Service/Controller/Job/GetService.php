<?php
declare(strict_types = 1);

namespace ApiBundle\Service\Controller\Job;

use ApiBundle\Model\Api\Engine\JobPaginationInterface;
use ApiBundle\Model\Api\Request\PaginationFactoryInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * GET: job
 */
class GetService
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(
        Container $container
    ) {
        $this->container = $container;
    }

    /**
     * Get job
     *
     * @param int $startAt
     * @param int $maxPerPage
     *
     * @return \ApiBundle\Model\Api\Response\Data\ErrorInterface | \ApiBundle\Model\Api\Response\Data\JobCollectionInterface
     */
    public function getJob($startAt, $maxPerPage)
    {
        /** @var PaginationFactoryInterface $paginationFactory */
        $paginationFactory  = $this->container->get('request_pagination_factory');
        $pagination         = $paginationFactory->create($startAt, $maxPerPage);

        /** @var ValidatorInterface $validator */
        $validator  = $this->container->get('validator');
        $errors     = $validator->validate($pagination);
        if (count($errors) > 0) {
            return $this->container
                ->get('service_error_render')
                ->render($errors);
        }

        /** @var JobPaginationInterface $engine */
        $engine = $this->container->get('engine_job_reporting');

        return $engine->getPage($pagination);
    }
}
