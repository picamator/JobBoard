<?php
namespace ApiBundle\Tests\Model;

use PHPUnit\Framework\TestCase;

/**
 * Base to share configuration over all tests
 */
abstract class BaseTest extends TestCase 
{
	protected function setUp() 
	{
		parent::setUp();
	}

    /**
     * Get EntityManager mock
     *
     * @return \Doctrine\ORM\EntityManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
	protected function getTransactionalEntityManagerMock()
    {
        $entityManagerMock = $this->getMockBuilder('Doctrine\ORM\EntityManagerInterface')
            ->getMock();

        $entityManagerMock->expects($this->any())
            ->method('transactional')
            ->willReturnCallback(function($callback) use ($entityManagerMock) {
                return call_user_func($callback, $entityManagerMock);
            });

        return $entityManagerMock;
    }
}
