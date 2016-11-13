<?php
namespace ApiBundle\Model\Api\Manager;

use ApiBundle\Model\Api\Entity\PublisherInterface;

/**
 * Publisher manager
 */
interface PublisherManagerInterface
{
    /**
     * Find publisher
     *
     * @param string $email
     *
     * @return PublisherInterface
     */
    public function findPublisher(string $email) : PublisherInterface;
}
