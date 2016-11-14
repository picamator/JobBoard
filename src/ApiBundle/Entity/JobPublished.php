<?php
declare(strict_types = 1);

namespace ApiBundle\Entity;

use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\JobPublishedInterface;

/**
 * JobPublished entity - flat representation of JobPool and Publisher, keeps only published jobs
 *
 * @codeCoverageIgnore
 */
class JobPublished implements JobPublishedInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $jobPoolId;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var \ApiBundle\Entity\JobPool
     */
    private $job_pool;

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
     * Set jobPoolId
     *
     * @param integer $jobPoolId
     *
     * @return JobPublishedInterface
     */
    public function setJobPoolId(int $jobPoolId) : JobPublishedInterface
    {
        $this->jobPoolId = $jobPoolId;

        return $this;
    }

    /**
     * Get jobPoolId
     *
     * @return integer
     */
    public function getJobPoolId() : int
    {
        return $this->jobPoolId;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return JobPublishedInterface
     */
    public function setTitle(string $title) : JobPublishedInterface
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return JobPublishedInterface
     */
    public function setDescription(string $description) : JobPublishedInterface
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return JobPublishedInterface
     */
    public function setEmail(string $email) : JobPublishedInterface
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
     * @return JobPublishedInterface
     */
    public function setCreatedAt(\DateTime $createdAt) : JobPublishedInterface
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set jobPool
     *
     * @param JobPoolInterface $job_pool
     *
     * @return JobPublishedInterface
     */
    public function setJobPool(JobPoolInterface $job_pool = null) : JobPublishedInterface
    {
        $this->job_pool = $job_pool;

        return $this;
    }

    /**
     * Get jobPool
     *
     * @return \ApiBundle\Entity\JobPool
     */
    public function getJobPool()
    {
        return $this->job_pool;
    }
}
