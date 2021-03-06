<?php
namespace Logger\Loggers;

use Psr\Log\LogLevel;

class ArrayLoggerTest extends \PHPUnit_Framework_TestCase {
	public function test() {
		$logger = new ArrayLogger();
		$this->assertCount(0, $logger->getMessages());
		$logger->info('hello world');
		$this->assertCount(1, $logger->getMessages());
		$this->assertEquals(array(array('level' => LogLevel::INFO, 'message' => 'hello world', 'context' => array())), $logger->getMessages());
		$logger->clearAll();
		$this->assertCount(0, $logger->getMessages());
	}
}
