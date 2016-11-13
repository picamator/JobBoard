<?php
namespace ApiBundle\Model\Api\Entity;

/**
 * JobStatus entity
 */
interface JobStatusInterface
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
     * @return JobStatusInterface
     */
    public function setSlug(string $slug) : JobStatusInterface;

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
     * @return JobStatusInterface
     */
    public function setName(string $name) : JobStatusInterface;

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
     * @return JobStatusInterface
     */
    public function setCreatedAt(\DateTime $createdAt) : JobStatusInterface;

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();
}
