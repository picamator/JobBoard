<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response;

use ApiBundle\Model\Api\Response\Data\CollectionInterface;
use ApiBundle\Model\Api\ObjectManagerInterface;
use ApiBundle\Model\Api\Response\CollectionFactoryInterface;

/**
 * Create Collection
 *
 * @codeCoverageIgnore
 */
class CollectionFactory implements CollectionFactoryInterface
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
        string $className = 'ApiBundle\Model\Response\Data\Collection'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function create(string $type, array $data) : CollectionInterface
    {
        return $this->objectManager->create($this->className, [$type, $data]);
    }
}
