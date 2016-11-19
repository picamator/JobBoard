<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Manager;

use ApiBundle\Model\Api\Entity\PublisherStatusInterface;
use ApiBundle\Model\Api\Manager\PublisherStatusManagerInterface;
use ApiBundle\Model\Api\Repository\PublisherStatusRepositoryInterface;
use ApiBundle\Model\Exception\UndefinedStatusException;

/**
 * Publisher Status manager
 */
class PublisherStatusManager implements PublisherStatusManagerInterface
{
    /**
     * @var string
     */
    private static $active = 'active';

    /**
     * @var string
     */
    private static $inactive = 'inactive';

    /**
     * @var
     */
    private static $awaitingModeration = 'awaitingModeration';

    /**
     * @var PublisherStatusRepositoryInterface
     */
    private $repository;

    /**
     * @param PublisherStatusRepositoryInterface $repository
     */
    public function __construct(PublisherStatusRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function getId(string $slug) : PublisherStatusInterface
    {
        $entity = $this->repository->findStatus($slug);

        if(is_null($entity) || is_null($entity->getId())) {
            throw new UndefinedStatusException(
                sprintf('Undefined status "%s', $slug)
            );
        }

        return $entity;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getActive() : PublisherStatusInterface
    {
        return $this->getId(self::$active);
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getInactive() : PublisherStatusInterface
    {
        return $this->getId(self::$inactive);
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getAwaitingModeration() : PublisherStatusInterface
    {
        return $this->getId(self::$awaitingModeration);
    }
}
