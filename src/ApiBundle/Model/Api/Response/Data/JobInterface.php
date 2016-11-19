<?php
namespace ApiBundle\Model\Api\Response\Data;

/**
 * Job value object
 */
interface JobInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId() : int;

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() : string;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() : string;

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() : string;

    /**
     * Get published date
     *
     * @return string
     */
    public function getPublishedDate() : string;
}
