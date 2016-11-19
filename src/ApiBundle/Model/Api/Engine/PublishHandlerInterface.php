<?php
namespace ApiBundle\Model\Api\Engine;

use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;

/**
 * Publish handler, implementation Chain of Responsibility pattern
 */
interface PublishHandlerInterface
{
    /**
     * Sets successor, if current handler can not process query
     *
     * @param PublishHandlerInterface $handler
     *
     * @return PublishHandlerInterface
     */
    public function setSuccessor(PublishHandlerInterface $handler) : self;

    /**
     * Handle, execute first handle that can manage JobPool
     *
     * @param PublisherInterface    $publisher
     * @param JobPoolInterface      $jobPool
     *
     * @return null | \JsonSerializable
     */
    public function handle(PublisherInterface $publisher, JobPoolInterface $jobPool);
}
