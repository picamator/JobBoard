<?php
namespace ApiBundle\Model\Command;

use ApiBundle\Model\Api\Command\TaskInterface;

/**
 * Task, command bus implementation
 *
 * @codeCoverageIgnore
 */
class Task implements TaskInterface
{
    /**
     * {@inheritdoc}
     */
    public function addTask(string $name, $data) : TaskInterface
    {
        // @todo in-progress
    }
}
