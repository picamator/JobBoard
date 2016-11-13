<?php
namespace ApiBundle\Model\Api\Token;

use ApiBundle\Model\Api\Entity\JobTokenInterface;

/**
 * Token validator, implementation Chain of Responsibility pattern
 */
interface ValidatorInterface
{
    /**
     * Validate
     *
     * @param JobTokenInterface $jobToken
     *
     * @return bool
     */
    public function validate(JobTokenInterface $jobToken) : bool;

    /**
     * Set validator
     *
     * @param ValidatorInterface $validator
     *
     * @return ValidatorInterface
     */
    public function setValidator(ValidatorInterface $validator) : ValidatorInterface;

    /**
     * Get error message
     *
     * @return string
     */
    public function getErrorMessage() : string;
}
