<?php
namespace ApiBundle\Tests\Model\Token\Validator;

use ApiBundle\Model\Token\Validator\Active;
use ApiBundle\Tests\Model\BaseTest;

class ActiveTest extends BaseTest
{
    /**
     * @var Active
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

        $this->validator = new Active();
    }

    public function testValid()
    {
        // job token mock
        $this->jobTokenMock->expects($this->once())
            ->method('getIsActive')
            ->willReturn(true);

        $actual = $this->validator->validate($this->jobTokenMock);

        $this->assertTrue($actual);
        $this->assertEmpty($this->validator->getErrorMessage());
    }

    public function testInvalid()
    {
        // job token mock
        $this->jobTokenMock->expects($this->once())
            ->method('getIsActive')
            ->willReturn(false);

        $actual = $this->validator->validate($this->jobTokenMock);

        $this->assertFalse($actual);
        $this->assertNotEmpty($this->validator->getErrorMessage());
    }
}

