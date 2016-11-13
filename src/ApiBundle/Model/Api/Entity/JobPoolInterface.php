<?php
namespace ApiBundle\Model\Api\Entity;

/**
 * JobPool entity
 */
interface JobPoolInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set publisherId
     *
     * @param integer $publisherId
     *
     * @return JobPoolInterface
     */
    public function setPublisherId(int $publisherId) : JobPoolInterface;

    /**
     * Get publisherId
     *
     * @return integer
     */
    public function getPublisherId() : int;

    /**
     * Set jobStatusId
     *
     * @param integer $jobStatusId
     *
     * @return JobPoolInterface
     */
    public function setJobStatusId(int $jobStatusId) : JobPoolInterface;

    /**
     * Get jobStatusId
     *
     * @return integer
     */
    public function getJobStatusId() : int;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return JobPoolInterface
     */
    public function setTitle(string $title) : JobPoolInterface;

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() : string;

    /**
     * Set description
     *
     * @param string $description
     *
     * @return JobPoolInterface
     */
    public function setDescription(string $description) : JobPoolInterface;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() : string;

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return JobPoolInterface
     */
    public function setCreatedAt(\DateTime $createdAt) : JobPoolInterface;

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
     * @return JobPoolInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt) : JobPoolInterface;

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Set publisher
     *
     * @param \ApiBundle\Entity\Publisher $publisher
     *
     * @return JobPoolInterface
     */
    public function setPublisher(\ApiBundle\Entity\Publisher $publisher = null) : JobPoolInterface;


    /**
     * Get publisher
     *
     * @return \ApiBundle\Entity\Publisher
     */
    public function getPublisher();

    /**
     * Set jobStatus
     *
     * @param \ApiBundle\Entity\JobStatus $jobStatus
     *
     * @return JobPoolInterface
     */
    public function setJobStatus(\ApiBundle\Entity\JobStatus $jobStatus = null) : JobPoolInterface;

    /**
     * Get jobStatus
     *
     * @return \ApiBundle\Entity\JobStatus
     */
    public function getJobStatus();
}
