<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response;

use ApiBundle\Model\Api\Entity\JobPublishedInterface;
use ApiBundle\Model\Api\Response\Data\JobInterface;
use ApiBundle\Model\Api\Response\JobBuilderInterface;
use ApiBundle\Model\Api\Response\JobFactoryInterface;

/**
 * Job factory
 */
class JobFactory implements JobFactoryInterface
{
    /**
     * @var array ['Job' => 'Entity/JobPublished']
     */
    private static $schema = [
        'id'            => 'id',
        'title'         => 'title',
        'description'   => 'description',
        'email'         => 'email',
        'publishedDate' => 'createdAt',
    ];

    /**
     * @var JobBuilderInterface
     */
    private $jobBuilder;

    /**
     * @param JobBuilderInterface $jobBuilder
     */
    public function __construct(JobBuilderInterface $jobBuilder)
    {
        $this->jobBuilder = $jobBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function create(JobPublishedInterface $jobPublished) : JobInterface
    {
        foreach (self::$schema as $key => $value) {
            $key    = 'set' . ucfirst($key);
            $value  = 'get' . ucfirst($value);

            $this->jobBuilder->$key($jobPublished->$value());
        }

        return $this->jobBuilder->build();
    }
}
