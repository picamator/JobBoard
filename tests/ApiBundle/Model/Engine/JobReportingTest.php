<?php
namespace ApiBundle\Tests\Model\Engine;

use ApiBundle\Model\Engine\JobReporting;
use ApiBundle\Tests\Model\BaseTest;

class JobReportingTest extends BaseTest
{
    /**
     * @var JobReporting
     */
    private $jobReporting;

    /**
     * @var \ApiBundle\Model\Api\Manager\PublisherManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $publisherManagerMock;

    /**
     * @var \ApiBundle\Model\Api\Entity\JobPoolInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobPoolMock;

    /**
     * @var \ApiBundle\Model\Api\Engine\PublishHandlerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $publishHandlerMock;

    /**
     * @var \ApiBundle\Model\Api\Request\Data\JobPostingInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobPostingMock;

    protected function setUp()
    {
        parent::setUp();

        $this->publisherManagerMock = $this->getMockBuilder('ApiBundle\Model\Api\Manager\PublisherManagerInterface')
            ->getMock();

        $this->jobPoolMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\JobPoolInterface')
            ->getMock();

        $this->publishHandlerMock = $this->getMockBuilder('ApiBundle\Model\Api\Engine\PublishHandlerInterface')
            ->getMock();

        $this->jobPostingMock = $this->getMockBuilder('ApiBundle\Model\Api\Request\Data\JobPostingInterface')
            ->getMock();

        $this->jobReporting = new JobReporting(
            $this->publisherManagerMock,
            $this->jobPoolMock,
            $this->publishHandlerMock
        );
    }

    public function testReport()
    {
        $title = 'title';
        $description = 'description';
        $email = 'test@job-board.dev.com';

        // job posting mock
        $this->jobPostingMock->expects($this->once())
            ->method('getEmail')
            ->willReturn($email);

        $this->jobPostingMock->expects($this->once())
            ->method('getTitle')
            ->willReturn($title);

        $this->jobPostingMock->expects($this->once())
            ->method('getDescription')
            ->willReturn($description);

        // publisher manager mock
        $publisherMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\PublisherInterface')
            ->getMock();

        $this->publisherManagerMock->expects($this->once())
            ->method('findPublisher')
            ->with($this->equalTo($email))
            ->willReturn($publisherMock);

        // job pool mock
        $this->jobPoolMock->expects($this->once())
            ->method('setTitle')
            ->with($this->equalTo($title))
            ->willReturnSelf();

        $this->jobPoolMock->expects($this->once())
            ->method('setDescription')
            ->with($this->equalTo($description))
            ->willReturnSelf();

        // publish handler mock
        $this->publishHandlerMock->expects($this->once())
            ->method('handle')
            ->with($this->equalTo($publisherMock), $this->equalTo($this->jobPoolMock));

        $this->jobReporting->report($this->jobPostingMock);
    }
}
