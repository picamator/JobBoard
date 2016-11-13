<?php
namespace ApiBundle\Model\Api\Repository;
use ApiBundle\Model\Api\Entity\PublisherInterface;

/**
 * Publisher repository
 */
interface PublisherRepositoryInterface
{
    /**
     * Find publisher
     *
     * @param string $email
     *
     * @return PublisherInterface | null
     */
    public function findPublisher(string $email);
}
