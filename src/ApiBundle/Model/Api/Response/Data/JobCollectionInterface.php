<?php
namespace ApiBundle\Model\Api\Response\Data;

/**
 * Job collection
 */
interface JobCollectionInterface extends \IteratorAggregate
{
    /**
     * Get max per page
     *
     * @return int
     */
    public function getMaxPerPage() : int;

    /**
     * Get total
     *
     * @return int
     */
    public function getTotal() : int;

    /**
     * Get start at
     *
     * @return int
     */
    public function getStartAt() : int;

    /**
     * Get data
     *
     * @return CollectionInterface
     */
    public function getData() : CollectionInterface;

    /**
     * Get code
     *
     * @return int
     */
    public function getCode() : int;
}
