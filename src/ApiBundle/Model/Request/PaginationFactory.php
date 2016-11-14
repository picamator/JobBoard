<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Request;

use ApiBundle\Model\Api\ObjectManagerInterface;
use ApiBundle\Model\Api\Request\Data\PaginationInterface;
use ApiBundle\Model\Api\Request\PaginationFactoryInterface;

/**
 * Create Pagination
 *
 * @codeCoverageIgnore
 */
class PaginationFactory implements PaginationFactoryInterface
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
        string $className = 'ApiBundle\Model\Request\Data\Pagination'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function create($startAt, $maxPerPage) : PaginationInterface
    {
        // @todo extract filtering to service or create something similar to validators
        $startAt    = intval($startAt);
        $maxPerPage = intval($maxPerPage);

        return $this->objectManager->create($this->className, [$startAt, $maxPerPage]);
    }
}
