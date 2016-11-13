<?php
namespace ApiBundle\Model\Api\Manager;

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
     * @return int
     *
     * @throws UndefinedStatusException
     */
    public function getId(string $slug) : int;

    /**
     * Get "active" status identifier
     *
     * @return int
     *
     * @throws UndefinedStatusException
     */
    public function getActive() : int;

    /**
     * Get "inactive" status identifier
     *
     * @return int
     *
     * @throws UndefinedStatusException
     */
    public function getInactive() : int;

    /**
     * Get "awaitingModeration" status identifier
     *
     * @return int
     *
     * @throws UndefinedStatusException
     */
    public function getAwaitingModeration() : int;
}
