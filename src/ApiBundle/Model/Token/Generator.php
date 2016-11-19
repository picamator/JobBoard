<?php
namespace ApiBundle\Model\Token;

use ApiBundle\Model\Api\Token\GeneratorInterface;
use ApiBundle\Model\Exception\InvalidArgumentException;
use ApiBundle\Model\Exception\RuntimeException;

/**
 * Token generator
 */
class Generator implements GeneratorInterface
{
    /**
     * {@inheritdoc}
     */
    public function generate(int $length) : string
    {
        if ($length <= 0) {
            throw new InvalidArgumentException('Invalid length parameter. Length should equal more then 0.');
        }

        try {
            return random_bytes($length);
        } catch (\Exception $e) {
            throw new RuntimeException('Can not generate token', 0, $e);
        }
    }
}
