<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Repository\JobTokenRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Job Token repository
 */
class JobTokenRepository extends EntityRepository implements JobTokenRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findToken(int $jobPoolId)
    {
        $query = $this->createQueryBuilder('jt')
            ->select('partial jt.{id, jobPoolId, token, isActive}')
            ->where('jt.jobPoolId = ?1')
            ->setParameter(1, $jobPoolId)
            ->getQuery();

        $query->useResultCache(false);
        $result = $query->getOneOrNullResult();

        return $result[0] ?? null;
    }
}
