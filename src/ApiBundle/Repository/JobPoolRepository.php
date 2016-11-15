<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Repository\JobPoolRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Job Pool repository
 */
class JobPoolRepository extends EntityRepository  implements JobPoolRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findJob(int $id)
    {
        $query = $this->createQueryBuilder('jp')
            ->select('jp')
            ->select('partial jp.{id, publisherId, jobStatusId, title, description}')
            ->where('jp.id = ?1')
            ->setParameter(1, $id)
            ->getQuery();

        $query->useResultCache(true);
        $result = $query->getOneOrNullResult();

        return $result[0] ?? null;
    }
}
