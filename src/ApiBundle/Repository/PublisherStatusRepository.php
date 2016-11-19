<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Repository\PublisherStatusRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Publisher Status repository
 *
 * @codeCoverageIgnore
 */
class PublisherStatusRepository extends EntityRepository implements PublisherStatusRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findStatus(string $slug)
    {
        $query = $this->createQueryBuilder('ps')
            ->select('partial ps.{id, slug, name}')
            ->where('ps.slug = ?1')
            ->setParameter(1, $slug)
            ->getQuery();

        $query->useResultCache(true);

        return $query->getOneOrNullResult();
    }
}
