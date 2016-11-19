<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Manager;

use ApiBundle\Model\Api\Entity\PublisherInterface;
use ApiBundle\Model\Api\Manager\PublisherManagerInterface;
use ApiBundle\Model\Api\ObjectManagerInterface;
use ApiBundle\Model\Api\Repository\PublisherRepositoryInterface;

/**
 * Publisher manager
 */
class PublisherManager implements PublisherManagerInterface
{
    /**
     * @var PublisherRepositoryInterface
     */
    private $publisherRepository;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @param PublisherRepositoryInterface  $publisherRepository
     * @param ObjectManagerInterface        $objectManager
     * @param string                        $entityName
     */
    public function __construct(
        PublisherRepositoryInterface  $publisherRepository,
        ObjectManagerInterface        $objectManager,
        string                        $entityName = 'ApiBundle\Entity\Publisher'
    ) {
        $this->publisherRepository  = $publisherRepository;
        $this->objectManager        = $objectManager;
        $this->entityName           = $entityName;
    }

    /**
     * {@inheritdoc}
     */
    public function findPublisher(string $email) : PublisherInterface
    {
        $publisher = $this->publisherRepository->findPublisher($email);
        if(is_null($publisher)) {
            /** @var PublisherInterface $publisher */
            $publisher = $this->objectManager->create($this->entityName);
            $publisher->setEmail($email);
        }

        return $publisher;
    }
}
