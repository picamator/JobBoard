<?php
namespace ApiBundle\Model\Api\Request;

use ApiBundle\Model\Api\Request\Data\JobPostingInterface;

/**
 * Create Job Posting
 */
interface JobPostingFactoryInterface
{
    /**
     * Create
     *
     * @param array $content
     *
     * @return JobPostingInterface
     */
    public function create(array $content) : JobPostingInterface;
}
