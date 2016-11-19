<?php
namespace ApiBundle\Model\Token;

use ApiBundle\Model\Api\Entity\JobTokenInterface;
use ApiBundle\Model\Api\Token\ValidatorInterface;

/**
 * Token validator
 */
abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * Error message it's modifying in child classes
     *
     * @var string
     */
    protected $errorMessage = '';

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * {@inheritdoc}
     */
    final public function setValidator(ValidatorInterface $validator) : ValidatorInterface
    {
        if (is_null($this->validator)) {
            $this->validator = $validator;
            return $this;
        }

        $this->validator->setValidator($validator);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    final public function validate(JobTokenInterface $jobToken) : bool
    {
        $result = $this->isValid($jobToken);
        if ($result && !is_null($this->validator)) {
            $result = $this->validator->isValid($jobToken);
            $this->errorMessage = $this->validator->getErrorMessage();
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getErrorMessage() : string
    {
        return $this->errorMessage;
    }

    /**
     * Is valid
     *
     * @param JobTokenInterface $jobToken
     *
     * @return bool true for dispatching to next validator
     */
    abstract protected function isValid(JobTokenInterface $jobToken) : bool;
}
