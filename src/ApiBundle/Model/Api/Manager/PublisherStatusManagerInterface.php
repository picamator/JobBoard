<?php
namespace ApiBundle\Model\Api\Manager;

use ApiBundle\Model\Api\Entity\PublisherStatusInterface;
use ApiBundle\Model\Exception\UndefinedStatusException;

/**
 * Publisher Status manager
 */
interface PublisherStatusManagerInterface
{
    /**
     * Get status identifier by it's slug
     *
     * @param string $slug
     *
     * @return PublisherStatusInterface
     *
     * @throws UndefinedStatusException
     */
    public function getId(string $slug) : PublisherStatusInterface;

    /**
     * Get "active" status identifier
     *
     * @return PublisherStatusInterface
     *
     * @throws UndefinedStatusException
     */
    public function getActive() : PublisherStatusInterface;

    /**
     * Get "inactive" status identifier
     *
     * @return PublisherStatusInterface
     *
     * @throws UndefinedStatusException
     */
    public function getInactive() : PublisherStatusInterface;

    /**
     * Get "awaitingModeration" status identifier
     *
     * @return PublisherStatusInterface
     *
     * @throws UndefinedStatusException
     */
    public function getAwaitingModeration() : PublisherStatusInterface;
}
