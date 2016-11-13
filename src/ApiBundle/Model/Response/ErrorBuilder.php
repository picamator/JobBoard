<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response;

use ApiBundle\Model\Api\Response\ErrorBuilderInterface;
use ApiBundle\Model\Api\Response\Data\ErrorInterface;
use ApiBundle\Model\Api\ObjectManagerInterface;

/**
 * Builder for Error value object
 *
 * @codeCoverageIgnore
 */
class ErrorBuilder implements ErrorBuilderInterface
{
    /**
     * @var array
     */
    private static $defaultData = [
        'msg'   => 'Undefined Application Error',
        'code'  => 500
    ];

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @var array
     */
    private $data;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        string $className = 'ApiBundle\Model\Response\Data\Error'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function setMessage(string $message) : ErrorBuilderInterface
    {
        $this->data['msg'] = $message;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode(int $code) : ErrorBuilderInterface
    {
        $this->data['code'] = $code;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build() : ErrorInterface
    {
        if (empty($this->data['msg']) || empty($this->data['code'])) {
            $this->data = self::$defaultData;
        }

        /** @var LocationInterface $result */
        $result = $this->objectManager->create($this->className, [
            $this->data['msg'],
            $this->data['code']
        ]);
        $this->cleanData();

        return $result;
    }

    /**
     * Clean data
     */
    private function cleanData()
    {
        $this->data = [];
    }
}
