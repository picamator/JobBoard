<?php
namespace ApiBundle\Tests\Model\Engine;

use ApiBundle\Model\Engine\JobPagination;
use ApiBundle\Tests\Model\BaseTest;

class JobPaginationTest extends BaseTest
{
    /**
     * @var JobPagination
     */
    private $jobPagination;

    /**
     * @var \ApiBundle\Model\Api\Repository\JobPublishedRepositoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobPublishedRepositoryMock;

    /**
     * @var \ApiBundle\Model\Api\Response\JobCollectionBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobCollectionBuilderMock;

    /**
     * @var \ApiBundle\Model\Api\Response\CollectionFactoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionFactoryMock;

    /**
     * @var \ApiBundle\Model\Api\Response\JobFactoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobFactoryMock;

    /**
     * @var \ApiBundle\Model\Api\Request\Data\PaginationInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $paginationMock;

    /**
     * @var \ApiBundle\Model\Api\Entity\JobPublishedInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobPublishedMock;

    /**
     * @var \ApiBundle\Model\Api\Response\Data\JobCollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobCollectionMock;

    protected function setUp()
    {
        parent::setUp();

        $this->jobPublishedRepositoryMock = $this->getMockBuilder('ApiBundle\Model\Api\Repository\JobPublishedRepositoryInterface')
            ->getMock();

        $this->jobCollectionBuilderMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\JobCollectionBuilderInterface')
            ->getMock();

        $this->collectionFactoryMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\CollectionFactoryInterface')
            ->getMock();

        $this->jobFactoryMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\JobFactoryInterface')
            ->getMock();

        $this->paginationMock = $this->getMockBuilder('ApiBundle\Model\Api\Request\Data\PaginationInterface')
            ->getMock();

        $this->jobPublishedMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\JobPublishedInterface')
            ->getMock();

        $this->jobCollectionMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\Data\JobCollectionInterface')
            ->getMock();

        $this->jobPagination = new JobPagination(
            $this->jobPublishedRepositoryMock,
            $this->jobCollectionBuilderMock,
            $this->collectionFactoryMock,
            $this->jobFactoryMock
        );
    }

    public function testGetPage()
    {
        $startAt = 1;
        $maxPerPage = 10;
        $total = 100;

        // pagination mock
        $this->paginationMock->expects($this->exactly(2))
            ->method('getStartAt')
            ->willReturn($startAt);

        $this->paginationMock->expects($this->exactly(2))
            ->method('getMaxPerPage')
            ->willReturn($maxPerPage);

        // job published repository mock
        $this->jobPublishedRepositoryMock->expects($this->once())
            ->method('findPage')
            ->with($this->equalTo($startAt), $this->equalTo($maxPerPage))
            ->willReturn([$this->jobPublishedMock]);

        $this->jobPublishedRepositoryMock->expects($this->once())
            ->method('getTotal')
            ->willReturn($total);

        // job factory mock
        $jobMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\Data\JobInterface')
            ->getMock();

        $this->jobFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->jobPublishedMock))
            ->willReturn($jobMock);

        // collection factory mock
        $collectionMock =$this->getMockBuilder('ApiBundle\Model\Api\Response\Data\CollectionInterface')
            ->getMock();

        $this->collectionFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('ApiBundle\Model\Api\Response\Data\JobInterface'), $this->equalTo([$jobMock]))
            ->willReturn($collectionMock);

        // job collection builder mock
        $this->jobCollectionBuilderMock->expects($this->once())
            ->method('setTotal')
            ->with($this->equalTo($total))
            ->willReturnSelf();

        $this->jobCollectionBuilderMock->expects($this->once())
            ->method('setStartAt')
            ->with($this->equalTo($startAt))
            ->willReturnSelf();

        $this->jobCollectionBuilderMock->expects($this->once())
            ->method('setMaxPerPage')
            ->with($this->equalTo($maxPerPage))
            ->willReturnSelf();

        $this->jobCollectionBuilderMock->expects($this->once())
            ->method('setData')
            ->with($this->equalTo($collectionMock))
            ->willReturnSelf();

        $this->jobCollectionBuilderMock->expects($this->once())
            ->method('build')
            ->willReturn($this->jobCollectionMock);

        $this->jobPagination->getPage($this->paginationMock);
    }

    public function testEmptyGetPage()
    {
        $startAt = 1;
        $maxPerPage = 10;
        $total = 0;

        // pagination mock
        $this->paginationMock->expects($this->exactly(2))
            ->method('getStartAt')
            ->willReturn($startAt);

        $this->paginationMock->expects($this->exactly(2))
            ->method('getMaxPerPage')
            ->willReturn($maxPerPage);

        // job published repository mock
        $this->jobPublishedRepositoryMock->expects($this->once())
            ->method('findPage')
            ->with($this->equalTo($startAt), $this->equalTo($maxPerPage))
            ->willReturn([]);


        // collection factory mock
        $collectionMock =$this->getMockBuilder('ApiBundle\Model\Api\Response\Data\CollectionInterface')
            ->getMock();

        $this->collectionFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('ApiBundle\Model\Api\Response\Data\JobInterface'), $this->equalTo([]))
            ->willReturn($collectionMock);

        // job collection builder mock
        $this->jobCollectionBuilderMock->expects($this->once())
            ->method('setTotal')
            ->with($this->equalTo($total))
            ->willReturnSelf();

        $this->jobCollectionBuilderMock->expects($this->once())
            ->method('setStartAt')
            ->with($this->equalTo($startAt))
            ->willReturnSelf();

        $this->jobCollectionBuilderMock->expects($this->once())
            ->method('setMaxPerPage')
            ->with($this->equalTo($maxPerPage))
            ->willReturnSelf();

        $this->jobCollectionBuilderMock->expects($this->once())
            ->method('setData')
            ->with($this->equalTo($collectionMock))
            ->willReturnSelf();

        $this->jobCollectionBuilderMock->expects($this->once())
            ->method('build')
            ->willReturn($this->jobCollectionMock);

        // never
        $this->jobPublishedRepositoryMock->expects($this->never())
            ->method('getTotal');

        $this->jobFactoryMock->expects($this->never())
            ->method('create');

        $this->jobPagination->getPage($this->paginationMock);
    }
}
