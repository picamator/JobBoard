<?php
namespace ApiBundle\Model\Api\Command;

/**
 * Worker, part of command bus
 */
interface WorkerInterface
{
    /**
     * Consume task
     *
     * @return bool
     */
    public function consume() : bool;
}
