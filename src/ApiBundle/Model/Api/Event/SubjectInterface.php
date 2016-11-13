<?php
namespace ApiBundle\Model\Api\Event;

/**
 * Subject, implementation of observer pattern
 */
interface SubjectInterface
{
    /**
     * Attach
     *
     * @param string            $name
     * @param ObserverInterface $observer
     *
     * @return SubjectInterface
     */
    public function attach(string $name, ObserverInterface $observer) : SubjectInterface;

    /**
     * Detach
     *
     * @param string            $name
     * @param ObserverInterface $observer
     *
     * @return SubjectInterface
     */
    public function detach(string $name, ObserverInterface $observer) : SubjectInterface;

    /**
     * Notify
     *
     * @param string    $name
     * @param array     $data
     *
     * @return void
     */
    public function notify(string $name, ...$data);
}
