<?php
namespace ApiBundle\Model\Event;

use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Api\Event\SubjectInterface;
use ApiBundle\Model\Api\Manager\PublisherManagerInterface;

/**
 * Publisher subject
 *
 * @codeCoverageIgnore
 */
class PublisherSubject implements PublisherManagerInterface, SubjectInterface
{
    use SubjectTrait;

    /**
     * @var PublisherManagerInterface
     */
    private $publisherManager;

    /**
     * @param PublisherManagerInterface $publisherManager
     */
    public function __construct(
        PublisherManagerInterface $publisherManager
    ) {
        $this->publisherManager = $publisherManager;
    }

    /**
     * {@inheritdoc}
     *
     * @events beforeFind, afterFind
     */
    public function findPublisher(string $email) : PublisherInterface
    {
        $this->notify('beforeFind', $email);
        $publisher = $this->publisherManager->findPublisher($email);
        $this->notify('afterFind', $publisher);

        return $publisher;
    }
}
