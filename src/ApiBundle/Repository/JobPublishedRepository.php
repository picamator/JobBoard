<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Entity\JobPublishedInterface;
use ApiBundle\Model\Api\Repository\JobPublishedRepositoryInterface;
use ApiBundle\Model\Exception\InvalidArgumentException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * Job Published repository
 */
class JobPublishedRepository extends EntityRepository  implements JobPublishedRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findPage(int $maxPerPage, int $startAt) : array
    {
        if ($startAt <= 0) {
            throw new InvalidArgumentException(
                sprintf('Invalid startAt "%s". Please put correct parameter represents page number started from 1.', $startAt)
            );
        }

        $firstResult = $maxPerPage * ($startAt - 1);
        $query = $this->createQueryBuilder('jp')
            ->addSelect('jp.id')
            ->addSelect('jp.title')
            ->addSelect('jp.description')
            ->addSelect('jp.email')
            ->addSelect('jp.createdAt')
            ->setMaxResults($maxPerPage)
            ->setFirstResult($firstResult)
            ->getQuery();

        try {
            return $query->useResultCache(false)
                ->getResult();
        } catch (NoResultException $e) {
            return [];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTotal() : int
    {
        $query = $this->createQueryBuilder('jp')
            ->addSelect('COUNT(*) as count')
            ->getQuery();

        try {
            return $query->useResultCache(false)
                ->getSingleResult();
        } catch (NoResultException $e) {
            return 0;
        }
    }
}
