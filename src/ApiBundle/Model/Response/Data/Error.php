<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response\Data;

use ApiBundle\Model\Api\Data\ErrorInterface;

/**
 * Value object for Error
 *
 * @codeCoverageIgnore
 */
class Error implements ErrorInterface , \JsonSerializable
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param string    $message
     * @param int       $code
     */
    public function __construct(string $message, int $code)
    {
        $this->data = ['msg' => $message, 'code' => $code];
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage() : string
    {
        return $this->data['msg'];
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

    /**
     * {@inheritdoc}
     */
    public function __debugInfo()
    {
        return $this->data;
    }
}
