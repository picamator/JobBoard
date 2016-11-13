<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response\Data;

use ApiBundle\Model\Api\Data\CollectionInterface;

/**
 * Homogeneous objects container
 *
 * @codeCoverageIgnore
 */
class Collection implements CollectionInterface, \JsonSerializable
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $count;

    /**
     * @var \ArrayIterator
     */
    private $iterator;

    /**
     * @param array     $data
     * @param string    $type
     */
    public function __construct(array $data, string $type)
    {
        $this->data = $data;
        $this->type = $type;

        $this->iterator = new \ArrayIterator($data);
    }

    /**
     * {@inheritdoc}
     */
    public function getData() : array
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->iterator;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        if (is_null($this->count)) {
            $this->count = count($this->data);
        }

        return $this->count;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function __debugInfo()
    {
        return $this->data;
    }
}
