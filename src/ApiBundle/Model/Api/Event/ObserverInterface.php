<?php
namespace ApiBundle\Model\Api\Event;

/**
 * Observer, implementation of observer pattern
 */
interface ObserverInterface
{
    /**
     * Update
     *
     * @param SubjectInterface  $subject
     * @param array             $data
     *
     * @return void
     */
    public function update(SubjectInterface $subject, array $data);
}
