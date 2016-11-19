<?php
namespace ApiBundle\Model\Api\Command;

/**
 * Task, command bus implementation
 */
interface TaskInterface
{
    /**
     * Add task
     *
     * @param string $name
     *
     * @param int|string $data
     *
     * @return TaskInterface
     */
    public function addTask(string $name, $data) : TaskInterface;
}
