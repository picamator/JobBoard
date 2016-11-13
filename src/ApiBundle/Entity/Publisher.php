<?php
declare(strict_types = 1);

namespace ApiBundle\Entity;

use ApiBundle\Model\Api\Entity\PublisherInterface;

/**
 * Publisher entity
 *
 * @codeCoverageIgnore
 */
class Publisher implements PublisherInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $publisherStatusId;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $updatedAt;

    /**
     * @var \ApiBundle\Entity\PublisherStatus
     */
    private $publisherStatus;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set publisherStatusId
     *
     * @param integer $publisherStatusId
     *
     * @return PublisherInterface
     */
    public function setPublisherStatusId(int $publisherStatusId) : PublisherInterface
    {
        $this->publisherStatusId = $publisherStatusId;

        return $this;
    }

    /**
     * Get publisherStatusId
     *
     * @return integer
     */
    public function getPublisherStatusId() : int
    {
        return $this->publisherStatusId;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return PublisherInterface
     */
    public function setEmail(string $email) : PublisherInterface
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PublisherInterface
     */
    public function setCreatedAt(\DateTime $createdAt) : PublisherInterface
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return PublisherInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt) : PublisherInterface
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set publisherStatus
     *
     * @param \ApiBundle\Entity\PublisherStatus $publisherStatus
     *
     * @return PublisherInterface
     */
    public function setPublisherStatus(\ApiBundle\Entity\PublisherStatus $publisherStatus = null) : PublisherInterface
    {
        $this->publisherStatus = $publisherStatus;

        return $this;
    }

    /**
     * Get publisherStatus
     *
     * @return \ApiBundle\Entity\PublisherStatus
     */
    public function getPublisherStatus()
    {
        return $this->publisherStatus;
    }
}
