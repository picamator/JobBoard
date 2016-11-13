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
     * @var int
     */
    private $publisherId;

    /**
     * @var int
     */
    private $jobStatusId;

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
    private $jobStatus;

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
     * Set publisherId
     *
     * @param integer $publisherId
     *
     * @return JobPoolInterface
     */
    public function setPublisherId(int $publisherId) : JobPoolInterface
    {
        $this->publisherId = $publisherId;

        return $this;
    }

    /**
     * Get publisherId
     *
     * @return integer
     */
    public function getPublisherId() : int
    {
        return $this->publisherId;
    }

    /**
     * Set jobStatusId
     *
     * @param integer $jobStatusId
     *
     * @return JobPoolInterface
     */
    public function setJobStatusId(int $jobStatusId) : JobPoolInterface
    {
        $this->jobStatusId = $jobStatusId;

        return $this;
    }

    /**
     * Get jobStatusId
     *
     * @return integer
     */
    public function getJobStatusId() : int
    {
        return $this->jobStatusId;
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
     * @param \ApiBundle\Entity\JobStatus $jobStatus
     *
     * @return JobPoolInterface
     */
    public function setJobStatus(\ApiBundle\Entity\JobStatus $jobStatus = null) : JobPoolInterface
    {
        $this->jobStatus = $jobStatus;

        return $this;
    }

    /**
     * Get jobStatus
     *
     * @return \ApiBundle\Entity\JobStatus
     */
    public function getJobStatus()
    {
        return $this->jobStatus;
    }
}
