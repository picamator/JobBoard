<?php
namespace ApiBundle\Model\Api\Token;

use ApiBundle\Model\Exception\InvalidArgumentException;
use ApiBundle\Model\Exception\RuntimeException;

/**
 * Token generator
 */
interface GeneratorInterface
{
    /**
     * Generate token
     *
     * @param int length
     *
     * @return string
     *
     * @throws InvalidArgumentException | RuntimeException
     */
    public function generate(int $length) : string;
}
