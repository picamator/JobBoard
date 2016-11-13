<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response\Data;

use ApiBundle\Model\Api\Response\Data\CollectionInterface;
use ApiBundle\Model\Api\Response\Data\JobCollectionInterface;

/**
 * Job collection
 *
 * @codeCoverageIgnore
 */
class JobCollection implements JobCollectionInterface
{
    /**
     * @var int
     */
    private $maxPerPage;

    /**
     * @var int
     */
    private $total;

    /**
     * @var int
     */
    private $startAt;

    /**
     * @var CollectionInterface
     */
    private $data;

    /**
     * @param CollectionInterface $data
     * @param int $maxPerPage
     * @param int $startAt
     * @param int $total
     */
    public function __construct(
        CollectionInterface $data,
        int $maxPerPage,
        int $startAt,
        int $total
    ) {
        $this->data         = $data;
        $this->maxPerPage   = $maxPerPage;
        $this->startAt      = $startAt;
        $this->total        = $total;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->data->getIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function getMaxPerPage() : int
    {
        return $this->maxPerPage;
    }

    /**
     * {@inheritdoc}
     */
    public function getTotal() : int
    {
        return $this->total;
    }

    /**
     * {@inheritdoc}
     */
    public function getStartAt() : int
    {
        return $this->startAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getData() : CollectionInterface
    {
        return $this->data;
    }
}
