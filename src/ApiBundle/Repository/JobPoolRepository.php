<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Repository\JobPoolRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Job Pool repository
 *
 * @codeCoverageIgnore
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
            ->select('partial jp.{id, publisherId, jobStatusId, title, description}, partial p.{id, email}')
            ->join('p.publisher', 'p')
            ->where('jp.id = ?1')
            ->setParameter(1, $id)
            ->getQuery();

        $query->useResultCache(false);

        return $query->getOneOrNullResult();
    }
}
