<?php
namespace ApiBundle\Model\Api\Engine;

use ApiBundle\Model\Api\Request\Data\JobPostingInterface;

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
     * @return \ApiBundle\Model\Api\Response\Data\JobCollectionInterface | \ApiBundle\Model\Api\Response\Data\ErrorInterface
     */
    public function report(JobPostingInterface $jopPosting);
}
