<?php
namespace ApiBundle\Tests\Model\Engine\Publish;

use ApiBundle\Model\Engine\Publish\AutoHandler;
use ApiBundle\Tests\Model\BaseTest;

class AutoHandlerTest extends BaseTest
{
    /**
     * @var AutoHandler
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
     * @var \ApiBundle\Model\Api\Manager\JobPublishedManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobPublishedManagerMock;

    /**
     * @var \ApiBundle\Model\Api\Response\JobFactoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobFactoryMock;

    /**
     * @var \ApiBundle\Model\Api\Response\JobSeparatedFactoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobSeparatedFactoryMock;

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

        $this->jobPublishedManagerMock = $this->getMockBuilder('ApiBundle\Model\Api\Manager\JobPublishedManagerInterface')
            ->getMock();

        $this->jobFactoryMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\JobFactoryInterface')
            ->getMock();

        $this->jobSeparatedFactoryMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\JobSeparatedFactoryInterface')
            ->getMock();

        $this->publisherMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\PublisherInterface')
            ->getMock();

        $this->jobPoolMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\JobPoolInterface')
            ->getMock();

        $this->handler = new AutoHandler(
            $this->entityManagerMock,
            $this->publisherStatusManagerMock,
            $this->jobPublishedManagerMock,
            $this->jobFactoryMock,
            $this->jobSeparatedFactoryMock
        );
    }

    public function testSkipNoIdHandle()
    {
        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getId');

        // never
        $this->jobPublishedManagerMock->expects($this->never())
            ->method('autoPublish');
        $this->jobFactoryMock->expects($this->never())
            ->method('create');
        $this->jobSeparatedFactoryMock->expects($this->never())
            ->method('create');


        $this->handler->handle($this->publisherMock, $this->jobPoolMock);
    }

    public function testSkipNoActiveHandle()
    {
        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);

        // publisher status mock
        $this->publisherStatusManagerMock->expects($this->once())
            ->method('getActive')
            ->willReturn(1);

        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getPublisherStatusId')
            ->willReturn(2);

        // never
        $this->jobPublishedManagerMock->expects($this->never())
            ->method('autoPublish');
        $this->jobFactoryMock->expects($this->never())
            ->method('create');
        $this->jobSeparatedFactoryMock->expects($this->never())
            ->method('create');


        $this->handler->handle($this->publisherMock, $this->jobPoolMock);
    }

    public function testHandle()
    {
        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);

        // publisher status mock
        $this->publisherStatusManagerMock->expects($this->once())
            ->method('getActive')
            ->willReturn(1);

        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getPublisherStatusId')
            ->willReturn(1);

        // job published mock
        $jobPublishedMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\JobPublishedInterface')
            ->getMock();

        $this->jobPublishedManagerMock->expects($this->once())
            ->method('autoPublish')
            ->willReturn($jobPublishedMock);

        // job factory mock
        $jobMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\Data\JobInterface')
            ->getMock();

        $this->jobFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($jobPublishedMock))
            ->willReturn($jobMock);

        // job separated factory mock
        $jobSeparated = $this->getMockBuilder('ApiBundle\Model\Api\Response\Data\JobSeparatedInterface')
            ->getMock();

        $this->jobSeparatedFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($jobMock))
            ->willReturn($jobSeparated);

        $this->handler->handle($this->publisherMock, $this->jobPoolMock);
    }
}
