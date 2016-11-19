<?php
namespace ApiBundle\Model\Api\Manager;

use ApiBundle\Model\Api\Entity\JobStatusInterface;
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
     * @return JobStatusInterface
     *
     * @throws UndefinedStatusException
     */
    public function getId(string $slug) : JobStatusInterface;

    /**
     * Get "published" status identifier
     *
     * @return JobStatusInterface
     *
     * @throws UndefinedStatusException
     */
    public function getPublished() : JobStatusInterface;

    /**
     * Get "spam" status identifier
     *
     * @return JobStatusInterface
     *
     * @throws UndefinedStatusException
     */
    public function getSpam() : JobStatusInterface;

    /**
     * Get "forReview" status identifier
     *
     * @return JobStatusInterface
     *
     * @throws UndefinedStatusException
     */
    public function getForReview() : JobStatusInterface;
}
