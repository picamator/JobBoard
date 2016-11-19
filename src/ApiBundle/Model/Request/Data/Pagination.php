<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Request\Data;

use ApiBundle\Model\Api\Request\Data\PaginationInterface;

/**
 * Pagination value object
 *
 * @codeCoverageIgnore
 */
class Pagination implements PaginationInterface
{
    /**
     * @var int
     */
    private $startAt;

    /**
     * @var int
     */
    private $maxPerPage;

    /**
     * @param int $startAt
     * @param int $maxPerPage
     */
    public function __construct(int $startAt, int $maxPerPage)
    {
        $this->startAt      = $startAt;
        $this->maxPerPage   = $maxPerPage;
    }

    /**
     * {@inheritdoc}
     */
    public function getStartAt() : int
    {
        return $this->startAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getMaxPerPage() : int
    {
        return $this->maxPerPage;
    }
}
