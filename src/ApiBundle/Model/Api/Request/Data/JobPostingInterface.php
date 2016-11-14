<?php
namespace ApiBundle\Model\Api\Request\Data;

/**
 * Job posting
 */
interface JobPostingInterface
{
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
}
