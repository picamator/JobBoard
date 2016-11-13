<?php
namespace ApiBundle\Tests\Model\Engine\Publish;

use ApiBundle\Model\Engine\Publish\NoProceedHandler;
use ApiBundle\Tests\Model\BaseTest;

class NoProceedHandlerTest extends BaseTest
{
    /**
     * @var NoProceedHandler
     */
    private $handler;

    /**
     * @var \ApiBundle\Model\Api\Command\TaskInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $taskMock;

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

        $this->taskMock = $this->getMockBuilder('ApiBundle\Model\Api\Command\TaskInterface')
            ->getMock();

        $this->errorBuilderMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\ErrorBuilderInterface')
            ->getMock();

        $this->publisherMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\PublisherInterface')
            ->getMock();

        $this->jobPoolMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\JobPoolInterface')
            ->getMock();

        $this->handler = new NoProceedHandler(
            $this->taskMock,
            $this->errorBuilderMock
        );
    }

    public function testHandle()
    {
        // publisher mock
        $this->publisherMock->expects($this->once())
            ->method('getEmail');

        // job pool mock
        $this->jobPoolMock->expects($this->once())
            ->method('getId');

        // task mock
        $this->taskMock->expects($this->once())
            ->method('addTask');

        // error builder mock
        $this->errorBuilderMock->expects($this->once())
            ->method('setCode')
            ->with($this->equalTo(500))
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
