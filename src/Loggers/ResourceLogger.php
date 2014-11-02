<?php
namespace Logger\Loggers;

use Psr\Log\AbstractLogger;

class ResourceLogger extends AbstractLogger {
	/**
	 * @var resource
	 */
	private $resource = null;

	/**
	 * @param resource $resource
	 */
	public function __construct($resource) {
		$this->resource = $resource;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return void
	 */
	public function log($level, $message, array $context = array()) {
		fwrite($this->resource, $message);
	}
}