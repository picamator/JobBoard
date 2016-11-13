<?php
namespace ApiBundle\Tests\Model\Token\Validator;

use ApiBundle\Model\Token\Validator\Exist;
use ApiBundle\Tests\Model\BaseTest;

class ExistTest extends BaseTest
{
    /**
     * @var Exist
     */
    private $validator;

    /**
     * @var \ApiBundle\Model\Api\Entity\JobTokenInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $jobTokenMock;

    protected function setUp()
    {
        parent::setUp();

        $this->jobTokenMock = $this->getMockBuilder('ApiBundle\Model\Api\Entity\JobTokenInterface')
            ->getMock();

        $this->validator = new Exist();
    }

    public function testValid()
    {
        // job token mock
        $this->jobTokenMock->expects($this->once())
            ->method('getId')
            ->willReturn(1);

        $actual = $this->validator->validate($this->jobTokenMock);

        $this->assertTrue($actual);
        $this->assertEmpty($this->validator->getErrorMessage());
    }

    public function testInvalid()
    {
        // job token mock
        $this->jobTokenMock->expects($this->once())
            ->method('getId');

        $actual = $this->validator->validate($this->jobTokenMock);

        $this->assertFalse($actual);
        $this->assertNotEmpty($this->validator->getErrorMessage());
    }
}

