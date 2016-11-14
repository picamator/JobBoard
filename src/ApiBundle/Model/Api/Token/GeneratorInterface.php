<?php
namespace ApiBundle\Model\Api\Token;

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
     * @throws \ApiBundle\Model\Exception\InvalidArgumentException | \ApiBundle\Model\Exception\RuntimeException
     */
    public function generate(int $length) : string;
}
