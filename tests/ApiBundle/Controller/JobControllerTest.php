<?php
namespace ApiBundle\Tests\Model\Controller;

class JobControllerTest extends BaseTest
{
    /**
     * @var \ApiBundle\Controller\JobController | \PHPUnit_Framework_MockObject_MockObject
     */
    private $controllerMock;

    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag | \PHPUnit_Framework_MockObject_MockObject
     */
    private $parameterBagMock;

    /**
     * @var \Symfony\Component\HttpFoundation\Request | \PHPUnit_Framework_MockObject_MockObject
     */
    private $requestMock;

    /**
     * @var \ApiBundle\Model\Api\Response\Data\ErrorInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $responseMock;

    /**
     * @var \FOS\RestBundle\View\View | \PHPUnit_Framework_MockObject_MockObject
     */
    private $viewMock;

    protected function setUp()
    {
        parent::setUp();

        $this->parameterBagMock = $this->getMockBuilder('Symfony\Component\HttpFoundation\ParameterBag')
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMockBuilder('Symfony\Component\HttpFoundation\Request')
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->query = $this->parameterBagMock;

        $this->responseMock = $this->getMockBuilder('ApiBundle\Model\Api\Response\Data\ErrorInterface')
            ->getMock();

        $this->viewMock = $this->getMockBuilder('FOS\RestBundle\View\View')
            ->getMock();

        $this->controllerMock = $this->getMockBuilder('ApiBundle\Controller\JobController')
            ->disableOriginalConstructor()
            ->setMethods(['view', 'handleView', 'get'])
            ->getMock();
    }

    public function testGetAction()
    {
        // parameter bag mock
        $this->parameterBagMock->expects($this->exactly(2))
            ->method('get')
            ->withConsecutive(
                [$this->equalTo('startAt'), 1],
                [$this->equalTo('maxPerPage'), 20]
            );

        // response mock
        $this->responseMock->expects($this->once())
            ->method('getCode')
            ->willReturn(200);

        // service mock
        $serviceMock = $this->getMockBuilder('ApiBundle\Service\Controller\Job\GetService')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceMock->expects($this->once())
            ->method('getJob')
            ->willReturn($this->responseMock);

        // controller mock
        $this->controllerMock->expects($this->once())
            ->method('get')
            ->with('service_job_get')
            ->willReturn($serviceMock);

        $this->controllerMock->expects($this->once())
            ->method('view')
            ->willReturn($this->viewMock);

        $this->controllerMock->expects($this->once())
            ->method('handleView');

        $this->controllerMock->getAction($this->requestMock);
    }

    public function testPostAction()
    {
        // request mock
        $this->requestMock->expects($this->once())
            ->method('getContent')
            ->willReturn('');

        // response mock
        $this->responseMock->expects($this->once())
            ->method('getCode')
            ->willReturn(200);

        // service mock
        $serviceMock = $this->getMockBuilder('ApiBundle\Service\Controller\Job\PostService')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceMock->expects($this->once())
            ->method('postJob')
            ->willReturn($this->responseMock);

        // controller mock
        $this->controllerMock->expects($this->once())
            ->method('get')
            ->with('service_job_post')
            ->willReturn($serviceMock);

        $this->controllerMock->expects($this->once())
            ->method('view')
            ->willReturn($this->viewMock);

        $this->controllerMock->expects($this->once())
            ->method('handleView');

        $this->controllerMock->postAction($this->requestMock);
    }
}
