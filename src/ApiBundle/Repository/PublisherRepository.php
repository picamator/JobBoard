<?php
declare(strict_types = 1);

namespace ApiBundle\Repository;

use ApiBundle\Model\Api\Repository\PublisherRepositoryInterface;

/**
 * Publisher repository
 */
class PublisherRepository implements PublisherRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findPublisher(string $email)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->addSelect('p.id')
            ->addSelect('p.publisherStatusId')
            ->addSelect('p.email')
            ->where('p.email = ?1')
            ->setParameter(1, $email)
            ->getQuery();

        $query->useResultCache(true);
        $result = $query->getOneOrNullResult();

        return $result[0] ?? null;
    }
}
