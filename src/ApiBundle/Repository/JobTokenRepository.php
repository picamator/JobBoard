<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Repository\JobTokenRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Job Token repository
 *
 * @codeCoverageIgnore
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
            ->join('p.job_pool', 'jp')
            ->where('jt.jobPoolId = ?1')
            ->setParameter(1, $jobPoolId)
            ->getQuery();

        $query->useResultCache(false);

        return $query->getOneOrNullResult();
    }
}
