<?php
namespace ApiBundle\Tests\Model\Token;

use ApiBundle\Tests\Model\BaseTest;

class AbstractValidatorTest extends BaseTest
{
    /**
     * @var \ApiBundle\Model\Token\AbstractValidator | \PHPUnit_Framework_MockObject_MockObject
     */
    private $validatorMock;

    protected function setUp()
    {
        parent::setUp();

        $this->validatorMock = $this->getMockBuilder('ApiBundle\Model\Token\AbstractValidator')
            ->setMethods(['isValid'])
            ->getMockForAbstractClass();
    }

    public function testSetValidator()
    {
        // validator mock
        $validatorFirstMock = $this->getMockBuilder('ApiBundle\Model\Api\Token\ValidatorInterface')
            ->getMock();

        $validatorSecondMock = $this->getMockBuilder('ApiBundle\Model\Api\Token\ValidatorInterface')
            ->getMock();

        $validatorFirstMock->expects($this->once())
            ->method('setValidator')
            ->with($this->equalTo($validatorSecondMock))
            ->willReturnSelf();

        $this->validatorMock
            ->setValidator($validatorFirstMock)
            ->setValidator($validatorSecondMock);
    }

    public function testValidate()
    {
        $resultFirst    = true;
        $resultSecond   = false;

        // validator mock
        $validatorFirstMock = $this->getMockBuilder('ApiBundle\Model\Token\AbstractValidator')
            ->setMethods(['isValid'])
            ->getMockForAbstractClass();

        $validatorFirstMock->expects($this->once())
            ->method('isValid')
            ->willReturn($resultFirst);

        $validatorSecondMock = $this->getMockBuilder('ApiBundle\Model\Token\AbstractValidator')
            ->setMethods(['isValid'])
            ->getMockForAbstractClass();

        $validatorSecondMock->expects($this->once())
            ->method('isValid')
            ->willReturn($resultSecond);

        $validatorThirdMock = $this->getMockBuilder('ApiBundle\Model\Token\AbstractValidator')
            ->setMethods(['isValid'])
            ->getMockForAbstractClass();

        $validatorThirdMock->expects($this->never())
            ->method('isValid');

        $validatorFirstMock
            ->setValidator($validatorSecondMock)
            ->setValidator($validatorThirdMock);

        // job token mock
        $jobTokenMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\JobTokenInterface')
            ->getMock();

        $actual = $validatorFirstMock->validate($jobTokenMock);
        $this->assertEquals($actual, $resultSecond);
    }
}
