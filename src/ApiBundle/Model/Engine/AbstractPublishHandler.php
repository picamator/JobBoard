<?php
namespace ApiBundle\Model\Engine;

use ApiBundle\Model\Api\Engine\PublishHandlerInterface;
use ApiBundle\Model\Api\Entity\JobPoolInterface;
use ApiBundle\Model\Api\Entity\PublisherInterface;

/**
 * Publish handler
 */
abstract class AbstractPublishHandler implements PublishHandlerInterface
{
    /**
     * @var HandlerInterface
     */
    private $successor;

    /**
     * {@inheritdoc}
     */
    final public function setSuccessor(PublishHandlerInterface $handler) : PublishHandlerInterface
    {
        if (is_null($this->successor)) {
            $this->successor = $handler;
            return $this;
        }
        $this->successor->setSuccessor($handler);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    final public function handle(PublisherInterface $publisher, JobPoolInterface $jobPool)
    {
        $result = $this->process($publisher, $jobPool);

        if (is_null($result) && !is_null($this->successor)) {
            $result = $this->successor->handle($publisher, $jobPool);
        }

        return $result;
    }

    /**
     * Process
     *
     * @param PublisherInterface $publisher
     * @param JobPoolInterface   $jobPool
     *
     * @return mixed | null null for dispatching to next successor
     */
    abstract protected function process(PublisherInterface $publisher, JobPoolInterface $jobPool);
}
