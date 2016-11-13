<?php
namespace ApiBundle\Model\Api\Manager;

use ApiBundle\Model\Exception\UndefinedStatusException;

/**
 * Publisher Status manager
 */
interface JobStatusManagerInterface
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
     * Get "published" status identifier
     *
     * @return int
     *
     * @throws UndefinedStatusException
     */
    public function getPublished() : int;

    /**
     * Get "spam" status identifier
     *
     * @return int
     *
     * @throws UndefinedStatusException
     */
    public function getSpam() : int;

    /**
     * Get "forReview" status identifier
     *
     * @return int
     *
     * @throws UndefinedStatusException
     */
    public function getForReview() : int;
}
