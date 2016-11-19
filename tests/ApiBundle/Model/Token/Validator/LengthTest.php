<?php
namespace ApiBundle\Tests\Model\Token\Validator;

use ApiBundle\Model\Token\Validator\Length;
use ApiBundle\Tests\Model\BaseTest;

class GeneratorTest extends BaseTest
{
    /**
     * @var Length
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

        $this->validator = new Length();
    }

    public function testValid()
    {
        // job token mock
        $this->jobTokenMock->expects($this->once())
            ->method('getToken')
            ->willReturn(str_repeat('1', 32));

        $actual = $this->validator->validate($this->jobTokenMock);

        $this->assertTrue($actual);
        $this->assertEmpty($this->validator->getErrorMessage());
    }

    public function testInvalid()
    {
        // job token mock
        $this->jobTokenMock->expects($this->once())
            ->method('getToken')
            ->willReturn(str_repeat('1', 10));

        $actual = $this->validator->validate($this->jobTokenMock);

        $this->assertFalse($actual);
        $this->assertNotEmpty($this->validator->getErrorMessage());
    }
}

