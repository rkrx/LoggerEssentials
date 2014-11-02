<?php
namespace Kir\Logging\Loggers;

use Psr\Log\AbstractLogger;

class CallbackLogger extends AbstractLogger {
	/**
	 * @var callable
	 */
	private $callable = null;

	/**
	 * @param callable $callable
	 */
	public function __construct($callable) {
		$this->callable = $callable;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param mixed $level
	 * @param string $message
	 * @param array $context
	 * @return void
	 */
	public function log($level, $message, array $context = array()) {
		try {
			call_user_func($this->callable, $level, $message, $context);
		} catch(\Exception $e) {
		}
	}
}