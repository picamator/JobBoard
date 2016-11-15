<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Repository\PublisherRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Publisher repository
 */
class PublisherRepository extends EntityRepository  implements PublisherRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findPublisher(string $email)
    {
        $query = $this->createQueryBuilder('p')
            ->select('partial p.{id, publisherStatusId, email}')
            ->where('p.email = ?1')
            ->setParameter(1, $email)
            ->getQuery();

        $query->useResultCache(true);
        $result = $query->getOneOrNullResult();

        return $result[0] ?? null;
    }
}
