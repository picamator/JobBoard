<?php
namespace ApiBundle\Model\Api\Response\Data;

/**
 * Homogeneous objects collection
 */
interface CollectionInterface extends \IteratorAggregate, \Countable
{
    /**
     * Retrieve data
     *
     * @return array
     */
    public function getData() : array;

    /**
     * Retrieve object's type
     *
     * @return string object's interface
     */
    public function getType() : string;
}
