<?php
namespace ApiBundle\Tests\Model\Token;

use ApiBundle\Model\Api\Event\SubjectInterface;
use ApiBundle\Model\Event\SubjectTrait;
use ApiBundle\Tests\Model\BaseTest;

class SubjectTraitTest extends BaseTest
{
    /**
     * @var \ApiBundle\Model\Api\Event\SubjectInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $subject;

    protected function setUp()
    {
        parent::setUp();

        // due to strict type it's impossible to use traitMock
        $this->subject = new class implements SubjectInterface {
            use SubjectTrait;
        };
    }

    public function testAttach()
    {
        // observer mock
        $observerMock = $this->getMockBuilder('ApiBundle\Model\Api\Event\ObserverInterface')
            ->getMock();

        $observerMock->expects($this->once())
            ->method('update');

        $this->subject->attach('test', $observerMock)
            ->notify('test');
    }

    public function testDetach()
    {
        // observer mock
        $observerMock = $this->getMockBuilder('ApiBundle\Model\Api\Event\ObserverInterface')
            ->getMock();

        // never
        $observerMock->expects($this->never())
            ->method('update');

        $this->subject->detach('test', $observerMock)
            ->notify('test');
    }
}
