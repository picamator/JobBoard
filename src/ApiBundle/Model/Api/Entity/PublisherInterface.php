<?php
namespace ApiBundle\Model\Api\Entity;

/**
 * Publisher entity
 */
interface PublisherInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set publisherStatusId
     *
     * @param integer $publisherStatusId
     *
     * @return PublisherInterface
     */
    public function setPublisherStatusId(int $publisherStatusId) : PublisherInterface;

    /**
     * Get publisherStatusId
     *
     * @return integer
     */
    public function getPublisherStatusId() : int;

    /**
     * Set email
     *
     * @param string $email
     *
     * @return PublisherInterface
     */
    public function setEmail(string $email) : PublisherInterface;

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() : string;

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PublisherInterface
     */
    public function setCreatedAt(\DateTime $createdAt) : PublisherInterface;

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return PublisherInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt) : PublisherInterface;

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Set publisherStatus
     *
     * @param \ApiBundle\Entity\PublisherStatus $publisherStatus
     *
     * @return PublisherInterface
     */
    public function setPublisherStatus(\ApiBundle\Entity\PublisherStatus $publisherStatus = null) : PublisherInterface;

    /**
     * Get publisherStatus
     *
     * @return \ApiBundle\Entity\PublisherStatus
     */
    public function getPublisherStatus();
}
