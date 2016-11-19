<?php
declare(strict_types = 1);

namespace ApiBundle\Model\Manager;

use ApiBundle\Model\Api\Manager\JobTokenManagerInterface;
use ApiBundle\Model\Api\ObjectManagerInterface;
use ApiBundle\Model\Api\Repository\JobTokenRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Prophecy\Argument\Token\TokenInterface;

/**
 * Job Token manager
 */
class JobTokenManager implements JobTokenManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var JobTokenRepositoryInterface
     */
    private $tokenRepository;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @param EntityManagerInterface        $entityManager
     * @param JobTokenRepositoryInterface   $tokenRepository
     * @param ObjectManagerInterface        $objectManager
     * @param string                        $entityName
     */
    public function __construct(
        EntityManagerInterface      $entityManager,
        JobTokenRepositoryInterface $tokenRepository,
        ObjectManagerInterface      $objectManager,
        string                      $entityName = 'ApiBundle\Entity\Token'
    ) {
        $this->entityManager    = $entityManager;
        $this->tokenRepository  = $tokenRepository;
        $this->objectManager    = $objectManager;
        $this->entityName       = $entityName;
    }

    /**
     * {@inheritdoc}
     */
    public function findToken(int $jobPoolId) : TokenInterface
    {
        $publisher = $this->tokenRepository->findToken($jobPoolId) ??
            $this->objectManager->create($this->entityName);

        return $publisher;
    }

    /**
     * {@inheritdoc}
     */
    public function saveToken(TokenInterface $token)
    {
        $this->entityManager
            ->persist($token);
    }
}
