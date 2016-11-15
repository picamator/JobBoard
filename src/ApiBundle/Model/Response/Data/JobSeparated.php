<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response\Data;

use ApiBundle\Model\Api\Response\Data\JobInterface;
use ApiBundle\Model\Api\Response\Data\JobSeparatedInterface;

/**
 * Job Separated, uses to represent one particular job
 *
 * @codeCoverageIgnore
 */
class JobSeparated implements JobSeparatedInterface, \JsonSerializable
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param JobInterface  $data
     * @param int           $code
     */
    public function __construct(JobInterface $data, int $code)
    {
        $this->data = [
            'data' => $data,
            'code' => $code,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getData() : JobInterface
    {
        return $this->data['data'];
    }

    /**
     * {@inheritdoc}
     */
    public function getCode() : int
    {
        return $this->data['code'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->data;
    }
}
