<?php
namespace ApiBundle\Model\Api\Response;

use ApiBundle\Model\Api\Response\Data\JobInterface;
use ApiBundle\Model\Exception\RuntimeException;

/**
 * Build Job value object
 */
interface JobBuilderInterface
{
    /**
     * Set id
     *
     * @param int $id
     *
     * @return JobBuilderInterface
     */
    public function setId(int $id) : JobBuilderInterface;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return JobBuilderInterface
     */
    public function setTitle(string $title) : JobBuilderInterface;

    /**
     * Set description
     *
     * @param string $description
     *
     * @return JobBuilderInterface
     */
    public function setDescription(string $description) : JobBuilderInterface;

    /**
     * Set email
     *
     * @param string $email
     *
     * @return JobBuilderInterface
     */
    public function setEmail(string $email) : JobBuilderInterface;

    /**
     * Set published date
     *
     * @param \DateTime $publishedDate
     *
     * @return JobBuilderInterface
     */
    public function setPublishedDate(\DateTime $publishedDate) : JobBuilderInterface;

    /**
     * Build
     *
     * @return JobInterface
     *
     * @throws RuntimeException
     */
    public function build() : JobInterface;
}
