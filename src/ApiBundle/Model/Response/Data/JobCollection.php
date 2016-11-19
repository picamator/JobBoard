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
class JobCollection implements JobCollectionInterface, \JsonSerializable
{
    /**
     * @var array
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
        $this->data = [
            'data'          => $data,
            'maxPerPage'    => $maxPerPage,
            'startAt'       => $startAt,
            'total'         => $total,
            'code'          => 200,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->data['data']->getIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function getMaxPerPage() : int
    {
        return $this->data['maxPerPage'];
    }

    /**
     * {@inheritdoc}
     */
    public function getTotal() : int
    {
        return $this->data['total'];
    }

    /**
     * {@inheritdoc}
     */
    public function getStartAt() : int
    {
        return $this->data['startAt'];
    }

    /**
     * {@inheritdoc}
     */
    public function getData() : CollectionInterface
    {
        return $this->data['data'];
    }

    /**
     * {@inheritdoc}
     */
    public function getCode() : int
    {
        return $this->data['code'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->data;
    }
}
