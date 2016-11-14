<?php
namespace ApiBundle\Model\Api\Response\Data;

/**
 * Job Separated, uses to represent one particular job
 */
interface JobSeparatedInterface
{
    /**
     * Get data
     *
     * @return JobInterface
     */
    public function getData() : JobInterface;

    /**
     * Get code
     *
     * @return int
     */
    public function getCode() : int;
}
