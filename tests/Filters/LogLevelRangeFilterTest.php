<?php
namespace Logger\Filters;

use Logger\Common\TestLogger;
use Psr\Log\LogLevel;

class LogLevelRangeFilterTest extends \PHPUnit_Framework_TestCase {
	public function test() {
		$testLogger = new TestLogger();
		$logger = new LogLevelRangeFilter($testLogger, LogLevel::DEBUG, LogLevel::WARNING);

		$logger->error('error');
		$this->assertNotEquals('error', $testLogger->getLastLine());

		$logger->alert('alert');
		$this->assertNotEquals('alert', $testLogger->getLastLine());

		$logger->warning('warning');
		$this->assertEquals('warning', $testLogger->getLastLine());

		$logger->debug('debug');
		$this->assertEquals('debug', $testLogger->getLastLine());
	}
}
