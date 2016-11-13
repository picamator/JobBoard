<?php
namespace ApiBundle\Model\Token\Validator;

use ApiBundle\Model\Api\Entity\JobTokenInterface;
use ApiBundle\Model\Token\AbstractValidator;

class Exist extends AbstractValidator
{
    /**
     * @var string
     */
    private $messageTmp;

    /**
     * @param string $messageTmp
     */
    public function __construct(string $messageTmp = 'Token does not exist')
    {
        $this->messageTmp = $messageTmp;
    }

    /**
     * {@inheritdoc}
     */
    protected function isValid(JobTokenInterface $jobToken) : bool
    {
        if (!empty($jobToken->getId())) {
            return true;
        }

        $this->errorMessage = $this->messageTmp;

        return false;
    }
}
