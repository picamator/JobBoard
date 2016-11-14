<?php
namespace ApiBundle\Model\Api\Response;

use ApiBundle\Model\Api\Response\Data\JobInterface;
use ApiBundle\Model\Api\Response\Data\JobSeparatedInterface;

/**
 * Create Job Separated value object
 */
interface JobSeparatedFactoryInterface
{
    /**
     * Create
     *
     * @param JobInterface $data
     * @param int $code
     *
     * @return JobSeparatedInterface
     */
    public function create(JobInterface $data, int $code = 200) : JobSeparatedInterface;
}
