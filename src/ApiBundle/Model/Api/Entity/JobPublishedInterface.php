<?php
namespace ApiBundle\Model\Api\Entity;

/**
 * JobPublished entity - flat representation of JobPool and Publisher, keeps only published jobs
 */
interface JobPublishedInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set jobPoolId
     *
     * @param integer $jobPoolId
     *
     * @return JobPublishedInterface
     */
    public function setJobPoolId(int $jobPoolId) : JobPublishedInterface;

    /**
     * Get jobPoolId
     *
     * @return integer
     */
    public function getJobPoolId() : int;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return JobPublishedInterface
     */
    public function setTitle(string $title) : JobPublishedInterface;

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
     * @return JobPublishedInterface
     */
    public function setDescription(string $description) : JobPublishedInterface;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() : string;

    /**
     * Set email
     *
     * @param string $email
     *
     * @return JobPublishedInterface
     */
    public function setEmail(string $email) : JobPublishedInterface;

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
     * @return JobPublishedInterface
     */
    public function setCreatedAt(\DateTime $createdAt) : JobPublishedInterface;

    /**
     * Get createdAt
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set jobPool
     *
     * @param JobPoolInterface $jobPool
     *
     * @return JobPublishedInterface
     */
    public function setJobPool(JobPoolInterface $jobPool = null) : JobPublishedInterface;

    /**
     * Get jobPool
     *
     * @return \ApiBundle\Entity\JobPool
     */
    public function getJobPool();
}
