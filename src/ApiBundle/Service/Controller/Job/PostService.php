<?php
declare(strict_types = 1);

namespace ApiBundle\Service\Controller\Job;

use ApiBundle\Model\Api\Engine\JobReportingInterface;
use ApiBundle\Model\Api\Request\JobPostingFactoryInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * POST: job
 */
class PostService
{
    /**
     * @var string
     */
    private static $errorMessageEmpty = 'Con not save your posting. Job has empty content. Please check your request and try again.';

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
     * Post job
     *
     * @param string $content
     *
     * @return \ApiBundle\Model\Api\Response\Data\ErrorInterface | \ApiBundle\Model\Api\Response\Data\JobSeparatedInterface
     */
    public function postJob(string $content)
    {
        $content = json_decode($content, true);
        if (!$content) {
            $badRequest = $this->container->get('service_controller_error_bad_request');

            return $badRequest->getResponse(self::$errorMessageEmpty);
        }

        /** @var JobPostingFactoryInterface $jobPostingFactory */
        $jobPostingFactory  = $this->container->get('request_job_posting_factory');
        $jobPosting         = $jobPostingFactory->create($content);

        /** @var ValidatorInterface $validator */
        $validator  = $this->container->get('validator');
        $errors     = $validator->validate($jobPosting);
        if (count($errors) > 0) {
           return $this->container
               ->get('service_error_render')
               ->render($errors);
        }

        /** @var JobReportingInterface $engine */
        $engine = $this->container->get('engine_job_reporting');

        return $engine->report($jobPosting);
    }
}
