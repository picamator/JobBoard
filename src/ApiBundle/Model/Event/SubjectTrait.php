<?php
namespace ApiBundle\Model\Event;

use ApiBundle\Model\Api\Event\ObserverInterface;

/**
 * Subject, part of observer pattern implementation
 */
trait SubjectTrait
{
    /**
     * @var array
     */
    private $observerContainer = [];

    /**
     * Attach
     *
     * @param string            $name
     * @param ObserverInterface $observer
     *
     * @return SubjectInterface
     */
    public function attach(string $name, ObserverInterface $observer) : SubjectInterface
    {
        $observerList = $this->getObserverList($name);
        $observerList->attach($observer);

        return $this;
    }

    /**
     * Detach
     *
     * @param string            $name
     * @param ObserverInterface $observer
     *
     * @return SubjectInterface
     */
    public function detach(string $name, ObserverInterface $observer) : SubjectInterface
    {
        $observerList = $this->getObserverList($name);
        $observerList->detach($observer);

        return $this;
    }

    /**
     * Notify
     *
     * @param string    $name
     * @param array     $data
     *
     * @return void
     */
    public function notify(string $name, ...$data)
    {
        $observerList = $this->getObserverList($name);
        /** @var ObserverInterface $item */
        foreach ($observerList as $item) {
            $item->update($this, $data);
        }
    }

    /**
     * Retrieve observer list.
     *
     * @param string $name
     *
     * @return \SplObjectStorage
     */
    private function getObserverList(string $name) : \SplObjectStorage
    {
        if (empty($this->observerContainer[$name])) {
            $this->observerContainer[$name] = new \SplObjectStorage();
        }

        return $this->observerContainer[$name];
    }
}
