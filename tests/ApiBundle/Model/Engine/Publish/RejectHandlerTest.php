<?php
namespace ApiBundle\Tests\Model\Engine\Publish;

use ApiBundle\Model\Engine\Publish\RejectHandler;
use ApiBundle\Tests\Model\BaseTest;

class RejectedHandlerTest extends BaseTest
{
    /**
     * @var RejectHandler
     */
    private $handler;

    /**
     * @var \ApiBundle\Model\Api\Manager\PublisherStatusManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $publisherStatusManagerMock;

    /**
     * @var \ApiBundle\Model\Api\Response\ErrorBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $errorBuilderMock;

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

        $this->publisherStatusManagerMock = $this->getMockBuilder('ApiBundle\Model\Api\Manager\PublisherStatusManagerInterface')
            ->getMock();

        $this->errorBuilderMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\ErrorBuilderInterface')
            ->getMock();

        $this->publisherMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\PublisherInterface')
            ->getMock();

        $this->jobPoolMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\JobPoolInterface')
            ->getMock();

        $this->handler = new RejectHandler(
            $this->publisherStatusManagerMock,
            $this->errorBuilderMock
        );
    }

    public function testSkipNoIdHandle()
    {
        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getId');

        // never
        $this->publisherStatusManagerMock->expects($this->never())
            ->method('getAwaitingModeration');
        $this->errorBuilderMock->expects($this->never())
            ->method('build');

        $this->handler->handle($this->publisherMock, $this->jobPoolMock);
    }

    public function testSkipNoAwaitingHandle()
    {
        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);

        // publisher status manager mock
        $this->publisherStatusManagerMock->expects($this->once())
            ->method('getAwaitingModeration')
            ->willReturn(1);

        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getPublisherStatusId')
            ->willReturn(2);

        //never
        $this->errorBuilderMock->expects($this->never())
            ->method('build');

        $this->handler->handle($this->publisherMock, $this->jobPoolMock);
    }

    public function testHandle()
    {
        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);

        // publisher status manager mock
        $this->publisherStatusManagerMock->expects($this->once())
            ->method('getAwaitingModeration')
            ->willReturn(1);

        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getPublisherStatusId')
            ->willReturn(1);

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
