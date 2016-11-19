<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response;

use ApiBundle\Model\Api\ObjectManagerInterface;
use ApiBundle\Model\Api\Response\Data\JobInterface;
use ApiBundle\Model\Api\Response\Data\JobSeparatedInterface;
use ApiBundle\Model\Api\Response\JobSeparatedFactoryInterface;

/**
 * Create Job Separated value object
 *
 * @codeCoverageIgnore
 */
class JobSeparatedFactory implements JobSeparatedFactoryInterface
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @param ObjectManagerInterface    $objectManager
     * @param string                    $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        string $className = 'ApiBundle\Model\Response\Data\JobSeparated'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function create(JobInterface $data, int $code = 200) : JobSeparatedInterface
    {
        return $this->objectManager->create($this->className, [$data, $code]);
    }
}
