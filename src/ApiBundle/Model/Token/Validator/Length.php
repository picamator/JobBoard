<?php
namespace ApiBundle\Model\Token\Validator;

use ApiBundle\Model\Api\Entity\JobTokenInterface;
use ApiBundle\Model\Token\AbstractValidator;

class Length extends AbstractValidator
{
    /**
     * @var int
     */
    private $length;

    /**
     * @var string
     */
    private $messageTmp;

    /**
     * @param int       $length
     * @param string    $messageTmp
     */
    public function __construct(int $length = 32, string $messageTmp = 'Invalid token size. Token should have length "%s".')
    {
        $this->length       = $length;
        $this->messageTmp   = $messageTmp;
    }

    /**
     * {@inheritdoc}
     */
    protected function isValid(JobTokenInterface $jobToken) : bool
    {
        if (strlen($jobToken->getToken()) === $this->length) {
            return true;
        }

        $this->errorMessage = sprintf($this->messageTmp, $this->length);

        return false;
    }
}
