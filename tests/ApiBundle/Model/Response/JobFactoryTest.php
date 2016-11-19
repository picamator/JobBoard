<?php
namespace ApiBundle\Tests\Model;

use ApiBundle\Model\Response\JobFactory;

class JobFactoryTest extends BaseTest
{
    /**
     * @var JobFactory
     */
    private $factory;

    /**
     * @var \ApiBundle\Model\Api\Response\JobBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobBuilderMock;

    /**
     * @var \ApiBundle\Model\Api\Entity\JobPublishedInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobPublishedMock;

    protected function setUp()
    {
        parent::setUp();

        $this->jobBuilderMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\JobBuilderInterface')
            ->getMock();

        $this->jobPublishedMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\JobPublishedInterface')
            ->getMock();

        $this->factory = new JobFactory($this->jobBuilderMock);
    }

    public function testCreate()
    {
        $id = 1;
        $title = 'test';
        $description = 'test';
        $email = 'test@test';
        $date = new \DateTime();

        // job published mock
        $this->jobPublishedMock->expects($this->once())
            ->method('getId')
            ->willReturn($id);

        $this->jobPublishedMock->expects($this->once())
            ->method('getTitle')
            ->willReturn($title);

        $this->jobPublishedMock->expects($this->once())
            ->method('getDescription')
            ->willReturn($description);

        $this->jobPublishedMock->expects($this->once())
            ->method('getEmail')
            ->willReturn($email);

        $this->jobPublishedMock->expects($this->once())
            ->method('getCreatedAt')
            ->willReturn($date);

        // job builder mock
        $this->jobBuilderMock->expects($this->once())
            ->method('setId')
            ->with($this->equalTo($id))
            ->willReturnSelf();

        $this->jobBuilderMock->expects($this->once())
            ->method('setTitle')
            ->with($this->equalTo($title))
            ->willReturnSelf();

        $this->jobBuilderMock->expects($this->once())
            ->method('setDescription')
            ->with($this->equalTo($description))
            ->willReturnSelf();

        $this->jobBuilderMock->expects($this->once())
            ->method('setEmail')
            ->with($this->equalTo($email))
            ->willReturnSelf();

        $this->jobBuilderMock->expects($this->once())
            ->method('setPublishedDate')
            ->with($this->equalTo($date))
            ->willReturnSelf();

        $jobMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\Data\JobInterface')
            ->getMock();
        $this->jobBuilderMock->expects($this->once())
            ->method('build')
            ->willReturn($jobMock);

        $this->factory->create($this->jobPublishedMock);
    }
}
