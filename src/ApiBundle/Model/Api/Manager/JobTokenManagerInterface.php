<?php
namespace ApiBundle\Model\Api\Manager;

use Prophecy\Argument\Token\TokenInterface;

/**
 * Job Token manager
 */
interface JobTokenManagerInterface
{
    /**
     * Find token
     *
     * @param int $jobPoolId
     *
     * @return TokenInterface
     */
    public function findToken(int $jobPoolId) : TokenInterface;

    /**
     * Save token
     *
     * @param TokenInterface $token
     *
     * @return void
     */
    public function saveToken(TokenInterface $token);
}
