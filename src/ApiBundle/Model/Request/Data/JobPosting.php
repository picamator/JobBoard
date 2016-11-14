<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Request\Data;

use ApiBundle\Model\Api\Request\Data\JobPostingInterface;

/**
 * Job posting
 *
 * @codeCoverageIgnore
 */
class JobPosting implements JobPostingInterface
{
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
     * @param string $title
     * @param string $description
     * @param string $email
     */
    public function __construct(string $title, string $description, string $email)
    {
        $this->title        = $title;
        $this->description  = $description;
        $this->email        = $email;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail() : string
    {
        return $this->email;
    }
}
