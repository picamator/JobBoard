<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Request;

use ApiBundle\Model\Api\ObjectManagerInterface;
use ApiBundle\Model\Api\Request\Data\JobPostingInterface;
use ApiBundle\Model\Api\Request\JobPostingFactoryInterface;

/**
 * Create Job Posting
 *
 * @codeCoverageIgnore
 */
class JobPostingFactory implements JobPostingFactoryInterface
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
        string $className = 'ApiBundle\Model\Request\Data\JobPosting'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $content) : JobPostingInterface
    {
        $title          = $content['title'] ?? '';
        $description    = $content['description'] ?? '';
        $email          = $content['email'] ?? '';

        return $this->objectManager->create($this->className, [$title, $description, $email]);
    }
}
