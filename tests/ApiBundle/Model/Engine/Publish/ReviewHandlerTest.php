<?php
namespace ApiBundle\Tests\Model\Engine\Publish;

use ApiBundle\Model\Engine\Publish\ReviewHandler;
use ApiBundle\Tests\Model\BaseTest;

class ReviewHandlerTest extends BaseTest
{
    /**
     * @var ReviewHandler
     */
    private $handler;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $entityManagerMock;

    /**
     * @var \ApiBundle\Model\Api\Manager\PublisherStatusManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $publisherStatusManagerMock;

    /**
     * @var \ApiBundle\Model\Api\Manager\JobPoolManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobPoolManagerMock;

    /**
     * @var \ApiBundle\Model\Api\Response\ErrorBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $errorBuilderMock;

    /**
     * @var \ApiBundle\Model\Api\Command\TaskInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $taskMock;

    /**
     * @var \ApiBundle\Model\Api\Entity\PublisherInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $publisherMock;

    /**
     * @var \ApiBundle\Model\Api\Entity\JobPoolInterface |  \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobPoolMock;

    protected function setUp()
    {
        parent::setUp();

        $this->entityManagerMock = $this->getTransactionalEntityManagerMock();

        $this->publisherStatusManagerMock = $this->getMockBuilder('ApiBundle\Model\Api\Manager\PublisherStatusManagerInterface')
            ->getMock();

        $this->jobPoolManagerMock = $this->getMockBuilder('ApiBundle\Model\Api\Manager\JobPoolManagerInterface')
            ->getMock();

        $this->taskMock = $this->getMockBuilder('ApiBundle\Model\Api\Command\TaskInterface')
            ->getMock();

        $this->errorBuilderMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\ErrorBuilderInterface')
            ->getMock();

        $this->publisherMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\PublisherInterface')
            ->getMock();

        $this->jobPoolMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\JobPoolInterface')
            ->getMock();

        $this->handler = new ReviewHandler(
            $this->entityManagerMock,
            $this->publisherStatusManagerMock,
            $this->jobPoolManagerMock,
            $this->taskMock,
            $this->errorBuilderMock
        );
    }

    public function testSkipNoInactiveHandle()
    {
        // publisher status manager mock
        $statusMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\PublisherStatusInterface')
            ->getMock();

        $statusMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);

        $this->publisherStatusManagerMock->expects($this->once())
            ->method('getInactive')
            ->willReturn($statusMock);

        // publisher mock
        $publisherStatusMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\PublisherStatusInterface')
            ->getMock();

        $publisherStatusMock->expects($this->once())
            ->method('getId')
            ->willReturn(2);

        $this->publisherMock->expects($this->once())
            ->method('getPublisherStatus')
            ->willReturn($publisherStatusMock);

        // never
        $this->jobPoolManagerMock->expects($this->never())
            ->method('saveForReview');
        $this->errorBuilderMock->expects($this->never())
            ->method('build');

        $this->handler->handle($this->publisherMock, $this->jobPoolMock);
    }

    public function testNewPublisherHandle()
    {
        // publisher status manager mock
        $statusMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\PublisherStatusInterface')
            ->getMock();

        $statusMock->expects($this->exactly(2))
            ->method('getId')
            ->willReturn(1);

        $this->publisherStatusManagerMock->expects($this->once())
            ->method('getInactive')
            ->willReturn($statusMock);

        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getPublisherStatus');

        // job pool manager mock
        $this->jobPoolManagerMock->expects($this->once())
            ->method('saveForReview')
            ->willReturn($this->jobPoolMock);

        // job pool mock
        $this->jobPoolMock->expects($this->exactly(2))
            ->method('getId');

        // task mock
        $this->taskMock->expects($this->exactly(2))
            ->method('addTask')
            ->willReturnSelf();

        // error builder mock
        $this->errorBuilderMock->expects($this->once())
            ->method('setCode')
            ->with($this->equalTo(200))
            ->willReturnSelf();

        $this->errorBuilderMock->expects($this->once())
            ->method('setMessage')
            ->willReturnSelf();

        $errorMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\Data\ErrorInterface')
            ->getMock();
        $this->errorBuilderMock->expects($this->once())
            ->method('build')
            ->willReturn($errorMock);

        $this->handler->handle($this->publisherMock, $this->jobPoolMock);
    }

    public function testHandle()
    {
        // publisher status manager mock
        $statusMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\PublisherStatusInterface')
            ->getMock();

        $statusMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);

        $this->publisherStatusManagerMock->expects($this->once())
            ->method('getInactive')
            ->willReturn($statusMock);

        // publisher mock
        $publisherStatusMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\PublisherStatusInterface')
            ->getMock();

        $publisherStatusMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);

        $this->publisherMock->expects($this->once())
            ->method('getPublisherStatus')
            ->willReturn($publisherStatusMock);

        // job pool manager mock
        $this->jobPoolManagerMock->expects($this->once())
            ->method('saveForReview')
            ->willReturn($this->jobPoolMock);

        // job pool mock
        $this->jobPoolMock->expects($this->exactly(2))
            ->method('getId');

        // task mock
        $this->taskMock->expects($this->exactly(2))
            ->method('addTask')
            ->willReturnSelf();

        // error builder mock
        $this->errorBuilderMock->expects($this->once())
            ->method('setCode')
            ->with($this->equalTo(200))
            ->willReturnSelf();

        $this->errorBuilderMock->expects($this->once())
            ->method('setMessage')
            ->willReturnSelf();

        $errorMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\Data\ErrorInterface')
            ->getMock();
        $this->errorBuilderMock->expects($this->once())
            ->method('build')
            ->willReturn($errorMock);

        $this->handler->handle($this->publisherMock, $this->jobPoolMock);
    }
}
