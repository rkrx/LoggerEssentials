<?php
namespace Logger\Formatters;

use Logger\Common\FormatterTestCase;
use Psr\Log\LogLevel;

class MaxLengthFormatterTest extends FormatterTestCase {
	public function testPlain() {
		$testLogger = $this->createTestLogger();
		$logger = new MaxLengthFormatter($testLogger, 7, '');
		$logger->log(LogLevel::DEBUG, 'This is a test');
		$this->assertEquals('This is', $testLogger->getLastLine());
	}

	public function testWithEllipsis() {
		$testLogger = $this->createTestLogger();
		$logger = new MaxLengthFormatter($testLogger, 11, ' ...');
		$logger->log(LogLevel::DEBUG, 'This is a test');
		$this->assertEquals('This is ...', $testLogger->getLastLine());
	}
}
