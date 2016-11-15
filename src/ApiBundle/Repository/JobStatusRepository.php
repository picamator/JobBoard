<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Repository\JobStatusRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Job Status repository
 *
 * @codeCoverageIgnore
 */
class JobStatusRepository extends EntityRepository implements JobStatusRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findStatus(string $slug)
    {
        $query = $this->createQueryBuilder('js')
            ->select('partial js.{id, slug, name}')
            ->where('js.slug = ?1')
            ->setParameter(1, $slug)
            ->getQuery();

        $query->useResultCache(true);

        return $query->getOneOrNullResult();
    }
}
