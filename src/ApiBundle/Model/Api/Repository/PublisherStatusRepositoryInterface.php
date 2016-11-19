<?php
namespace ApiBundle\Model\Api\Repository;

use ApiBundle\Model\Api\Entity\PublisherStatusInterface;

/**
 * Publisher Status repository
 */
interface PublisherStatusRepositoryInterface
{
    /**
     * Find status
     *
     * @param string $slug
     *
     * @return PublisherStatusInterface | null
     */
    public function findStatus(string $slug);
}
