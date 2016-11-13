<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Repository\JobStatusRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Job Status repository
 */
class JobStatusRepository extends EntityRepository implements JobStatusRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findStatus(string $slug)
    {
        $query = $this->createQueryBuilder('js')
            ->select('js')
            ->addSelect('js.id')
            ->addSelect('js.slug')
            ->addSelect('js.name')
            ->where('js.slug = ?1')
            ->setParameter(1, $slug)
            ->getQuery();

        $query->useResultCache(true);
        $result = $query->getOneOrNullResult();

        return $result[0] ?? null;
    }
}
