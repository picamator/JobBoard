<?php
namespace ApiBundle\Model\Command;

use ApiBundle\Model\Api\Command\TaskInterface;

/**
 * Task, command bus implementation
 */
class Task implements TaskInterface
{
    /**
     * {@inheritdoc}
     */
    public function addTask(string $name, $data) : TaskInterface
    {
        // @todo in-progress
       // var_dump('In Progress: Task was executed', $name, $data);
    }
}
