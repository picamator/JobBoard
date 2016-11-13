<?php
namespace ApiBundle\Tests\Model\Engine;

use ApiBundle\Tests\Model\BaseTest;

class AbstractPublishTest extends BaseTest
{
    /**
     * @var \ApiBundle\Model\Engine\AbstractPublishHandler | \PHPUnit_Framework_MockObject_MockObject
     */
    private $handlerMock;

    protected function setUp()
    {
        parent::setUp();

        $this->handlerMock = $this->getMockBuilder('ApiBundle\Model\Engine\AbstractPublishHandler')
            ->setMethods(['process'])
            ->getMockForAbstractClass();
    }

    public function testSetSuccessor()
    {
        // handler mock
        $handlerFirstMock = $this->getMockBuilder('ApiBundle\Model\Api\Engine\PublishHandlerInterface')
            ->getMock();

        $handlerSecondMock = $this->getMockBuilder('ApiBundle\Model\Api\Engine\PublishHandlerInterface')
            ->getMock();

        $handlerFirstMock->expects($this->once())
            ->method('setSuccessor')
            ->with($this->equalTo($handlerSecondMock))
            ->willReturnSelf();

        $this->handlerMock
            ->setSuccessor($handlerFirstMock)
            ->setSuccessor($handlerSecondMock);
    }

    public function testHandle()
    {
        $resultFirst    = null;
        $resultSecond   = true;

        // handler mock
        $handleFirstMock = $this->getMockBuilder('ApiBundle\Model\Engine\AbstractPublishHandler')
            ->setMethods(['process'])
            ->getMockForAbstractClass();

        $handleFirstMock->expects($this->once())
            ->method('process')
            ->willReturn($resultFirst);

        $handleSecondMock = $this->getMockBuilder('ApiBundle\Model\Engine\AbstractPublishHandler')
            ->setMethods(['process'])
            ->getMockForAbstractClass();

        $handleSecondMock->expects($this->once())
            ->method('process')
            ->willReturn($resultSecond);

        $handleThirdMock = $this->getMockBuilder('ApiBundle\Model\Engine\AbstractPublishHandler')
            ->setMethods(['process'])
            ->getMockForAbstractClass();

        $handleThirdMock->expects($this->never())
            ->method('process');

        $handleFirstMock
            ->setSuccessor($handleSecondMock)
            ->setSuccessor($handleThirdMock);

        // publisher mock
        $publisherMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\PublisherInterface')
            ->getMock();

        // job pool mock
        $jobPoolMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\JobPoolInterface')
            ->getMock();

        $actual = $handleFirstMock->handle($publisherMock, $jobPoolMock);
        $this->assertEquals($actual, $resultSecond);
    }
}
