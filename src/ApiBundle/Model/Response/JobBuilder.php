<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response;

use ApiBundle\Model\Api\ObjectManagerInterface;
use ApiBundle\Model\Api\Response\Data\JobInterface;
use ApiBundle\Model\Api\Response\JobBuilderInterface;
use ApiBundle\Model\Exception\RuntimeException;

/**
 * Build Job value object
 */
class JobBuilder implements JobBuilderInterface
{
    /**
     * @var string
     */
    private static $dateFormat = 'Y-m-d';

    /**
     * @var array
     */
    private $data = [
        'id'                => null,
        'title'             => null,
        'description'       => null,
        'email'             => null,
        'publicationDate'   => null,
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
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        string $className = 'ApiBundle\Model\Response\Data\Job'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function setId(int $id) : JobBuilderInterface
    {
        $this->data['id'] = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle(string $title) : JobBuilderInterface
    {
        $this->data['title'] = $title;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription(string $description) : JobBuilderInterface
    {
        $this->data['description'] = $description;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail(string $email) : JobBuilderInterface
    {
        $this->data['email'] = $email;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setPublishedDate(\DateTime $publishedDate) : JobBuilderInterface
    {
        $this->data['publishedDate'] =  $publishedDate->format(self::$dateFormat);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build() : JobInterface
    {
        $data = array_filter($this->data);
        if (count($data) !== count($this->data)) {
            throw new RuntimeException('Required data was not set. All setters should be filled');
        }

        /** @var SearchResultInterface $result */
        $result = $this->objectManager->create($this->className, $this->data);
        $this->cleanData();

        return $result;
    }

    /**
     * Clean data
     */
    private function cleanData()
    {
        $this->data = array_map(function() {
            return null;
        }, $this->data);
    }
}
