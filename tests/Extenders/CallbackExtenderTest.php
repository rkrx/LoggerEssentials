<?php
namespace Logger\Extenders;

use Logger\Common\TestLogger;
use Psr\Log\LogLevel;

class CallbackExtenderTest extends \PHPUnit_Framework_TestCase {
	public function testAll() {
		$testLogger = new TestLogger();
		$logger = new CallbackExtender($testLogger, function ($level, &$message) {
			if($level === LogLevel::INFO) {
				$message = preg_replace('/\\bworld\\b/', 'planet', $message);
			}
		});
		$logger->info('Hello world');
		$this->assertEquals('Hello planet', $testLogger->getLastLine());
	}
}
