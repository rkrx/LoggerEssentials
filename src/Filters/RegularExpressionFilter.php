<?php
namespace Logger\Filters;

use Logger\Common\AbstractLoggerAware;
use Psr\Log\LoggerInterface;

class RegularExpressionFilter extends AbstractLoggerAware {
	/**
	 * @var
	 */
	private $pattern;
	/**
	 * @var string
	 */
	private $modifiers;
	/**
	 * @var bool
	 */
	private $negate;

	/**
	 * @param LoggerInterface $logger
	 * @param $pattern
	 * @param string $modifiers
	 * @param bool $negate
	 */
	public function __construct(LoggerInterface $logger, $pattern, $modifiers = 'u', $negate = false) {
		parent::__construct($logger);
		$this->pattern = $pattern;
		$this->modifiers = $modifiers;
		$this->negate = !!$negate;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return void
	 */
	public function log($level, $message, array $context = array()) {
		$result = preg_match(sprintf("/%s/%s", preg_quote($this->pattern, '/'), $this->modifiers), $message);
		if(!$result !== $this->negate) {
			$this->logger()->log($level, $message, $context);
		}
	}
}