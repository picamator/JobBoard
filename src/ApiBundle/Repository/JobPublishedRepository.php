<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Repository\JobPublishedRepositoryInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * Job Published repository
 *
 * @codeCoverageIgnore
 */
class JobPublishedRepository extends EntityRepository  implements JobPublishedRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findPage(int $startAt, int $maxPerPage) : array
    {
        $firstResult = $maxPerPage * abs($startAt - 1);
        $query = $this->createQueryBuilder('jp')
            ->select('partial jp.{id, title, description, email, createdAt}')
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
            ->select('COUNT(jp)')
            ->getQuery();

        try {
            return (int) $query->useResultCache(false)
                ->getSingleScalarResult();

        } catch (NoResultException $e) {
            return 0;
        }
    }
}
