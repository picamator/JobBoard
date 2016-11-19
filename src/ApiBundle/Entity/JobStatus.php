<?php
declare(strict_types = 1);

namespace ApiBundle\Entity;

use ApiBundle\Model\Api\Entity\JobStatusInterface;

/**
 * JobStatus entity
 *
 * @codeCoverageIgnore
 */
class JobStatus implements JobStatusInterface
{
    /**
     * var int
     */
    private $id;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $createdAt;

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
     * Set slug
     *
     * @param string $slug
     *
     * @return JobStatusInterface
     */
    public function setSlug(string $slug) : JobStatusInterface
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() : string
    {
        return $this->slug;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return JobStatusInterface
     */
    public function setName(string $name) : JobStatusInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return JobStatusInterface
     */
    public function setCreatedAt(\DateTime $createdAt) :JobStatusInterface
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
}
