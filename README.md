rkr/logger-essentials
=====================
[![Build Status](https://travis-ci.org/LoggerEssentials/LoggerEssentials.svg?branch=master)](https://travis-ci.org/LoggerEssentials/LoggerEssentials) [![Latest Stable Version](https://poser.pugx.org/logger/logger/version.svg)](https://packagist.org/packages/logger/logger) [![Total Downloads](https://poser.pugx.org/logger/logger/downloads.svg)](https://packagist.org/packages/logger/logger) [![License](https://poser.pugx.org/logger/logger/license.svg)](https://packagist.org/packages/logger/logger)

A fully standards-compliant logging component library ([psr-3](http://www.php-fig.org/psr/psr-3/)) with some useful wrappers and adapters.

TOC

* [Common](#common)
* [Extenders](#extenders)
* [Filters](#filters)
* [Formatters](#formatters)
* [Loggers](#loggers)
* [Tools](#tools)
* [So, why not just go with already existing libraries?](#so-why-not-just-go-with-already-existing-libraries)


## Common

### `ExtendedLogger` for sub-loggers

You can create subloggers from a logger-instance. The reason is to easly create a base-context for all deriving log-messages. So you can track, how a certain log-message come from. In a different project, the call-context could be different.

```PHP
$psrLogger = ...;
$logger = new ExtendedPsrLoggerWrapper($psrLogger);
$logger = $logger->createSubLogger('Sub-Routine');
$logger = $logger->createSubLogger('Sub-Sub-Routine');
$logger->notice('Hello World'); // Sub-Routine / Sub-Sub-Routine: Hello World
```

### `LoggerCollection` for composite logging

With a `LoggerCollection` you can consolidate several loggers to a single logger. In addition to that, you may use `LogLevelRangeFilter` to filter certain log-levels from the input.  

```PHP
$errorLogger = new LoggerCollection();
$errorLogger->add(new ResourceLogger(STDERR));
$errorLogger->add(new ErrorLogLogger());
$errorLogger->add(new PushoverLogger(/* ... */));

$logger = new LoggerCollection();
$logger->add(new LogLevelRangeFilter($errorLogger, LogLevel::ERROR, LogLevel::EMERGENCY));
$errorLogger->add(new LogLevelRangeFilter(new ResourceLogger(STDOUT), LogLevel::INFO, LogLevel::WARNING));

$logger->error("This is a log message");
```


## Extenders

### `CallbackExtender` extends the `context` by using a callback-function 

### `ContextExtender` extends the `context` by using an (key-value-)array 


## Filters

### `CallbackFilter`

### `ExcludeLogLevelFilter`

### `LogLevelRangeFilter`

Define a range of valid log-levels.

```PHP
$logger = new LoggerCollection();
$logger->add(new SingleLogLevelFilterProxy(new StreamLogger(STDOUT), LogLevel::INFO, LogLevel::ERROR));
$logger->add(new SingleLogLevelFilterProxy(new StreamLogger(STDERR), LogLevel::ERROR, LogLevel::EMERGENCY));

$logger->notice('test');
```

### `RegularExpressionFilter`


## Formatters

### `CallbackFormatter`

### `ContextJsonFormatter`

### `DateTimeFormatter`

### `FormatFormatter`

### `MaxLengthFormatter`

### Add a message prefix to all messages with the `MessagePrefixFormatter`
Add a prefix to all log messages:

```PHP
$logger = new MessagePrefixProxy(new ResourceLogger(STDOUT), 'AddCustomer: ');
```

### `NobrFormatter`

### `PassThroughFormatter`

### `ReplaceFormatter`

### `TemplateFormatter`

### `TrimFormatter`


## Loggers

* [CallbackLogger](src/Loggers/CallbackLogger.php)
* [ErrorLogLogger](src/Loggers/ErrorLogLogger.php)
* [NullLogger](src/Loggers/NullLogger.php)
* [ResourceLogger](src/Loggers/ResourceLogger.php)
* [StreamLogger](src/Loggers/StreamLogger.php)
* [SyslogLogger](src/Loggers/SyslogLogger.php)


## Tools

### `Rfc5424LogLevels` and `LogLevelTranslator` for log-level conversion

```PHP
$psrLogLevel = LogLevel::DEBUG;
$rfc5454LogLevel = 7 - LogLevelTranslator::getLevelNo($psrLogLevel);
$rfc5454WarningLevel = 7 - LogLevelTranslator::getLevelNo(LogLevel::WARNING);
if($rfc5454LogLevel >= $rfc5454WarningLevel) {
	$logger->log($psrLogLevel, 'Test', array());
}
```

## So, why not just go with already existing libraries?
Compared with...

* [Monolog](doc/monolog.md)
* [KLogger](doc/klogger.md)
* [Log4PHP](doc/log4php.md)


