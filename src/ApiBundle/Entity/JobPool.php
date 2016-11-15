<?php
declare(strict_types = 1);

namespace ApiBundle\Entity;

use ApiBundle\Model\Api\Entity\JobPoolInterface;

/**
 * JobPool entity
 *
 * @codeCoverageIgnore
 */
class JobPool implements JobPoolInterface
{
    /**
     * @var int
     */
    private $id;

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
    private $createdAt;

    /**
     * @var string
     */
    private $updatedAt;

    /**
     * @var \ApiBundle\Entity\Publisher
     */
    private $publisher;

    /**
     * @var \ApiBundle\Entity\JobStatus
     */
    private $job_status;

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
     * Set title
     *
     * @param string $title
     *
     * @return JobPoolInterface
     */
    public function setTitle(string $title) : JobPoolInterface
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
     * @return JobPoolInterface
     */
    public function setDescription(string $description) : JobPoolInterface
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return JobPoolInterface
     */
    public function setCreatedAt(\DateTime $createdAt) : JobPoolInterface
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
     * @return JobPoolInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt) : JobPoolInterface
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
     * Set publisher
     *
     * @param \ApiBundle\Entity\Publisher $publisher
     *
     * @return JobPoolInterface
     */
    public function setPublisher(\ApiBundle\Entity\Publisher $publisher = null) : JobPoolInterface
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return \ApiBundle\Entity\Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set jobStatus
     *
     * @param \ApiBundle\Entity\JobStatus $job_status
     *
     * @return JobPoolInterface
     */
    public function setJobStatus(\ApiBundle\Entity\JobStatus $job_status = null) : JobPoolInterface
    {
        $this->job_status = $job_status;

        return $this;
    }

    /**
     * Get jobStatus
     *
     * @return \ApiBundle\Entity\JobStatus
     */
    public function getJobStatus()
    {
        return $this->job_status;
    }
}
