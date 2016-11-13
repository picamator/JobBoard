<?php
declare(strict_types = 1);

namespace ApiBundle\Entity;

use ApiBundle\Model\Api\Entity\JobTokenInterface;

/**
 * JobToken entity
 *
 * @codeCoverageIgnore
 */
class JobToken implements JobTokenInterface
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
    private $token;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $updatedAt;

    /**
     * @var \ApiBundle\Entity\JobPool
     */
    private $jobPool;


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
     * @return JobTokenInterface
     */
    public function setJobPoolId(int $jobPoolId) : JobTokenInterface
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
     * Set token
     *
     * @param string $token
     *
     * @return JobTokenInterface
     */
    public function setToken(string $token) :JobTokenInterface
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken() : string
    {
        return $this->token;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return JobTokenInterface
     */
    public function setIsActive(bool $isActive) : JobTokenInterface
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive() : bool
    {
        return $this->isActive;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return JobTokenInterface
     */
    public function setCreatedAt(\DateTime $createdAt) : JobTokenInterface
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
     * @return JobTokenInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt) : JobTokenInterface
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
     * Set jobPool
     *
     * @param \ApiBundle\Entity\JobPool $jobPool
     *
     * @return JobTokenInterface
     */
    public function setJobPool(\ApiBundle\Entity\JobPool $jobPool = null) : JobTokenInterface
    {
        $this->jobPool = $jobPool;

        return $this;
    }

    /**
     * Get jobPool
     *
     * @return \ApiBundle\Entity\JobPool
     */
    public function getJobPool()
    {
        return $this->jobPool;
    }
}
