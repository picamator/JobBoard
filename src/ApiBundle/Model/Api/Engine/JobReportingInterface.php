<?php
namespace ApiBundle\Model\Api\Engine;

use ApiBundle\Model\Api\Request\Data\JobPostingInterface;
use ApiBundle\Model\Api\Response\Data\ErrorInterface;
use ApiBundle\Model\Api\Response\Data\JobCollectionInterface;

/**
 * Job Reporting
 */
interface JobReportingInterface
{
    /**
     * Report
     *
     * @param JobPostingInterface $jopPosting
     *
     * @return JobCollectionInterface | ErrorInterface
     */
    public function report(JobPostingInterface $jopPosting);
}
