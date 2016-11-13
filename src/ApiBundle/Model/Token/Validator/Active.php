<?php
namespace ApiBundle\Model\Token\Validator;

use ApiBundle\Model\Api\Entity\JobTokenInterface;
use ApiBundle\Model\Token\AbstractValidator;

class Active extends AbstractValidator
{
    /**
     * @var string
     */
    private $messageTmp;

    /**
     * @param string $messageTmp
     */
    public function __construct(string $messageTmp = 'Token is not active')
    {
        $this->messageTmp = $messageTmp;
    }

    /**
     * {@inheritdoc}
     */
    protected function isValid(JobTokenInterface $jobToken) : bool
    {
        if ($jobToken->getIsActive()) {
            return true;
        }

        $this->errorMessage = $this->messageTmp;

        return false;
    }
}
