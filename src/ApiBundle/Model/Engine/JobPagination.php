<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Engine;

use ApiBundle\Model\Api\Engine\JobPaginationInterface;
use ApiBundle\Model\Api\Entity\JobPublishedInterface;
use ApiBundle\Model\Api\Repository\JobPublishedRepositoryInterface;
use ApiBundle\Model\Api\Request\Data\PaginationInterface;
use ApiBundle\Model\Api\Response\JobCollectionBuilderInterface;
use ApiBundle\Model\Api\Response\CollectionFactoryInterface;
use ApiBundle\Model\Api\Response\Data\JobCollectionInterface;
use ApiBundle\Model\Api\Response\JobFactoryInterface;

/**
 * Job pagination
 */
class JobPagination implements JobPaginationInterface
{
    /**
     * @var JobPublishedRepositoryInterface
     */
    private $jobPublishedRepository;

    /**
     * @var JobCollectionBuilderInterface
     */
    private $jobCollectionBuilder;

    /**
     * @var CollectionFactoryInterface
     */
    private $collectionFactory;

    /**
     * @var JobFactoryInterface
     */
    private $jobFactory;

    /**
     * @param JobPublishedRepositoryInterface   $jobPublishedRepository
     * @param JobCollectionBuilderInterface     $jobCollectionBuilder
     * @param CollectionFactoryInterface        $collectionFactory
     * @param JobFactoryInterface               $jobFactory
     */
    public function __construct(
        JobPublishedRepositoryInterface $jobPublishedRepository,
        JobCollectionBuilderInterface   $jobCollectionBuilder,
        CollectionFactoryInterface      $collectionFactory,
        JobFactoryInterface             $jobFactory
    ) {
        $this->jobPublishedRepository = $jobPublishedRepository;
        $this->jobCollectionBuilder   = $jobCollectionBuilder;
        $this->collectionFactory      = $collectionFactory;
        $this->jobFactory             = $jobFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getPage(PaginationInterface $pagination) : JobCollectionInterface
    {
        // repository data
        $jobList = $this->jobPublishedRepository->findPage($pagination->getStartAt(), $pagination->getMaxPerPage());
        $total   = empty($jobList) ? 0 : $this->jobPublishedRepository->getTotal();

        $data = [];
        /** @var JobPublishedInterface $item */
        foreach($jobList as $item) {
            $data[] = $this->jobFactory->create($item);
        }
        $collection = $this->collectionFactory->create('ApiBundle\Model\Api\Response\Data\JobInterface', $data);

        // collection builder
        $this->jobCollectionBuilder
            ->setTotal($total)
            ->setStartAt($pagination->getStartAt())
            ->setMaxPerPage($pagination->getMaxPerPage())
            ->setData($collection);

        return $this->jobCollectionBuilder->build();
    }
}
