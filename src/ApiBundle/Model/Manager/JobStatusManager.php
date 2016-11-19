<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Manager;

use ApiBundle\Model\Api\Entity\JobStatusInterface;
use ApiBundle\Model\Api\Manager\JobStatusManagerInterface;
use ApiBundle\Model\Api\Repository\JobStatusRepositoryInterface;
use ApiBundle\Model\Exception\UndefinedStatusException;

/**
 * Job Status manager
 */
class JobStatusManager implements JobStatusManagerInterface
{
    /**
     * @var string
     */
    private static $published = 'published';

    /**
     * @var string
     */
    private static $spam = 'spam';

    /**
     * @var
     */
    private static $forReview = 'forReview';

    /**
     * @var JobStatusRepositoryInterface
     */
    private $repository;

    /**
     * @param JobStatusRepositoryInterface $repository
     */
    public function __construct(JobStatusRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function getId(string $slug) : JobStatusInterface
    {
        $entity = $this->repository->findStatus($slug);

        if(is_null($entity) || is_null($entity->getId())) {
            throw new UndefinedStatusException(
                sprintf('Undefined status "%s"', $slug)
            );
        }

        return $entity;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getPublished() : JobStatusInterface
    {
        return $this->getId(self::$published);
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getSpam() : JobStatusInterface
    {
        return $this->getId(self::$spam);
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getForReview() : JobStatusInterface
    {
        return $this->getId(self::$forReview);
    }
}
