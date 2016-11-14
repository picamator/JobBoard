<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response;

use ApiBundle\Model\Api\ObjectManagerInterface;
use ApiBundle\Model\Api\Response\JobCollectionBuilderInterface;
use ApiBundle\Model\Api\Response\Data\CollectionInterface;
use ApiBundle\Model\Api\Response\Data\JobCollectionInterface;
use ApiBundle\Model\Exception\RuntimeException;

/**
 * Build Job collection
 */
class JobCollectionBuilder implements JobCollectionBuilderInterface
{
    /**
     * @var array
     */
    private $data = [
        'data'          => null,
        'maxPerPage'    => null,
        'startAt'       => null,
        'total'         => null,
    ];

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        string $className = 'ApiBundle\Model\Response\Data\JobCollection'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function setMaxPerPage(int $maxPerPage) : JobCollectionBuilderInterface
    {
        $this->data['maxPerPage'] = $maxPerPage;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setTotal(int $total) : JobCollectionBuilderInterface
    {
        $this->data['total'] = $total;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setStartAt(int $startAt) : JobCollectionBuilderInterface
    {
        $this->data['startAt'] = $startAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setData(CollectionInterface $data) : JobCollectionBuilderInterface
    {
        $this->data['data'] = $data;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build() : JobCollectionInterface
    {
        $data = array_filter($this->data, function($item) {
            return !is_null($item);
        });
        if (count($data) !== count($this->data)) {
            throw new RuntimeException('Required data was not set. All setters should be filled');
        }

        /** @var JobCollectionInterface $result */
        $result = $this->objectManager->create($this->className, $this->data);
        $this->cleanData();

        return $result;
    }

    /**
     * Clean data
     */
    private function cleanData()
    {
        $this->data = array_map(function() {
            return null;
        }, $this->data);
    }
}
