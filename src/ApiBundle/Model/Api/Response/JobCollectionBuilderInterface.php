<?php
namespace ApiBundle\Model\Api\Resopnse;

use ApiBundle\Model\Api\Response\Data\CollectionInterface;
use ApiBundle\Model\Api\Response\Data\JobCollectionInterface;

/**
 * Build Job collection
 */
interface JobCollectionBuilderInterface
{

    /**
     * Set max per page
     *
     * @param int $maxPerPage
     *
     * @return JobCollectionBuilderInterface
     */
    public function setMaxPerPage(int $maxPerPage) : JobCollectionBuilderInterface;

    /**
     * Set total
     *
     * @param int $total
     *
     * @return JobCollectionBuilderInterface
     */
    public function setTotal(int $total) : JobCollectionBuilderInterface;

    /**
     * Set start at
     *
     * @param int $startAt
     *
     * @return JobCollectionBuilderInterface
     */
    public function setStartAt(int $startAt) : JobCollectionBuilderInterface;

    /**
     * Set data
     *
     * @param CollectionInterface $data
     *
     * @return JobCollectionBuilderInterface
     */
    public function setData(CollectionInterface $data) : JobCollectionBuilderInterface;

    /**
     * Build
     *
     * @return JobCollectionInterface
     */
    public function build() : JobCollectionInterface;
}
