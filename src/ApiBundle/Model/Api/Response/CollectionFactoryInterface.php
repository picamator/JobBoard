<?php
namespace ApiBundle\Model\Api\Response;

use ApiBundle\Model\Api\Response\Data\CollectionInterface;

/**
 * Create Collection
 */
interface CollectionFactoryInterface
{
    /**
     * Create
     *
     * @param string    $type
     * @param array     $data
     *
     * @return CollectionInterface
     */
    public function create(string $type, array $data) : CollectionInterface;
}
