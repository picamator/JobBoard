<?php
namespace ApiBundle\Model\Api\Entity;

/**
 * JobToken entity
 */
interface JobTokenInterface
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
     * @return JobTokenInterface
     */
    public function setJobPoolId(int $jobPoolId) : JobTokenInterface;

    /**
     * Get jobPoolId
     *
     * @return integer
     */
    public function getJobPoolId() : int;

    /**
     * Set token
     *
     * @param string $token
     *
     * @return JobTokenInterface
     */
    public function setToken(string $token) : JobTokenInterface;

    /**
     * Get token
     *
     * @return string
     */
    public function getToken() : string;

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return JobTokenInterface
     */
    public function setIsActive(bool $isActive) : JobTokenInterface;

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive() : bool;

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return JobTokenInterface
     */
    public function setCreatedAt(\DateTime $createdAt) : JobTokenInterface;

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
     * @return JobTokenInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt) : JobTokenInterface;

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Set jobPool
     *
     * @param \ApiBundle\Entity\JobPool $jobPool
     *
     * @return JobTokenInterface
     */
    public function setJobPool(\ApiBundle\Entity\JobPool $jobPool = null) : JobTokenInterface;

    /**
     * Get jobPool
     *
     * @return \ApiBundle\Entity\JobPool
     */
    public function getJobPool();
}
