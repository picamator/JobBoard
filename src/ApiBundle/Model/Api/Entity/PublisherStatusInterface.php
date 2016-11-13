<?php
namespace ApiBundle\Model\Api\Entity;

/**
 * Publisher status entity
 */
interface PublisherStatusInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return PublisherStatusInterface
     */
    public function setSlug(string $slug) : PublisherStatusInterface;

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() : string;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PublisherStatusInterface
     */
    public function setName(string $name) : PublisherStatusInterface;

    /**
     * Get name
     *
     * @return string
     */
    public function getName() : string;

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PublisherStatusInterface
     */
    public function setCreatedAt(\DateTime $createdAt) : PublisherStatusInterface;


    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();
}
