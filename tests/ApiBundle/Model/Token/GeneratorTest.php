<?php
namespace ApiBundle\Tests\Model\Token;

use ApiBundle\Model\Token\Generator;
use ApiBundle\Tests\Model\BaseTest;

class GeneratorTest extends BaseTest
{
    /**
     * @var Generator
     */
    private $generator;

    protected function setUp()
    {
        parent::setUp();

        $this->generator = new Generator();
    }

    /**
     * @dataProvider providerGenerate
     *
     * @param int $length
     */
    public function testGenerate(int $length)
    {
        $token = $this->generator->generate($length);

        $this->assertEquals($length, strlen($token));
    }

    /**
     * @expectedException \ApiBundle\Model\Exception\InvalidArgumentException
     */
    public function testFailGenerate()
    {
        $this->generator->generate(-32);
    }

    public function providerGenerate()
    {
        return [
            [2],
            [8],
            [32],
            [64]
        ];
    }
}
