<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Response\Data;

use ApiBundle\Model\Api\Response\Data\JobInterface;

/**
 * Job value object
 *
 * @codeCoverageIgnore
 */
class Job implements JobInterface, \JsonSerializable
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param int       $id
     * @param string    $title
     * @param string    $description
     * @param string    $email
     * @param string    $publishedDate
     */
    public function __construct(
        int $id,
        string $title,
        string $description,
        string $email,
        string $publishedDate
    ) {
        $this->data = [
            'id'            => $id,
            'title'         => $title,
            'description'   => $description,
            'email'         => $email,
            'publishedDate' => $publishedDate,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId() : int
    {
        return $this->data['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle() : string
    {
        return $this->data['title'];
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription() : string
    {
        return $this->data['description'];
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail() : string
    {
        return $this->data['email'];
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishedDate() : string
    {
        return $this->data['PublishedDate'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function __debugInfo()
    {
        return $this->data;
    }
}
