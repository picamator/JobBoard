<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Manager;

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
    public function getId(string $slug) : int
    {
        $entity = $this->repository->findStatus($slug);

        if(is_null($entity) || is_null($entity->getId())) {
            throw new UndefinedStatusException(
                sprintf('Undefined status "%s', $slug)
            );
        }

        return $entity->getId();
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getActive() : int
    {
        return $this->getId(self::$active);
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getInactive() : int
    {
        return $this->getId(self::$inactive);
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getAwaitingModeration() : int
    {
        return $this->getId(self::$awaitingModeration);
    }
}
