<?php
namespace ApiBundle\Model\Api\Response;

use ApiBundle\Model\Api\Response\Data\ErrorInterface;

/**
 * Builder for Error value object
 */
interface ErrorBuilderInterface
{
    /**
     * Sets message
     *
     * @param string $message
     *
     * @return ErrorBuilderInterface
     */
    public function setMessage(string $message) : self;

    /**
     * Sets code
     *
     * @param int $code
     *
     * @return ErrorBuilderInterface
     */
    public function  setCode(int $code) : self;

    /**
     * Build
     *
     * @return ErrorInterface
     */
    public function build() : ErrorInterface;
}
