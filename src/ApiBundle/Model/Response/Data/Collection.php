<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response\Data;

use ApiBundle\Model\Api\Response\Data\CollectionInterface;

/**
 * Homogeneous objects container
 *
 * @codeCoverageIgnore
 */
class Collection implements CollectionInterface, \JsonSerializable
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $data;

    /**
     * @var int
     */
    private $count;

    /**
     * @var \ArrayIterator
     */
    private $iterator;

    /**
     * @param string    $type
     * @param array     $data
     */
    public function __construct(string $type, array $data)
    {
        $this->type = $type;
        $this->data = $data;

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
