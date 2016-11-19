<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Repository\PublisherRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Publisher repository
 *
 * @codeCoverageIgnore
 */
class PublisherRepository extends EntityRepository  implements PublisherRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findPublisher(string $email)
    {
        $query = $this->createQueryBuilder('p')
            ->select('partial p.{id, email}, partial ps.{id, slug}')
            ->join('p.publisher_status', 'ps')
            ->where('p.email = ?1')
            ->setParameter(1, $email)
            ->getQuery();

        $query->useResultCache(false);

        return $query->getOneOrNullResult();
    }
}
