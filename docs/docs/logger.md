First, every Logger has a `channel`, which is a name that will be associated with each entry of the logger log, and each part of the application can have a logger with a different channel to better differentiate them, facilitating the filtering of information,

To the Logger must be added one or more `handlers` that are components that record the logs in certain ways, like the classic files or sockets and databases for example.

Another important concept in the use of logs is the level of the log record, not all information has the same “importance” in the log, or the same urgency to be dealt with, so entries in a log are categorized by levels:

- **DEBUG:** Debug information.
- **INFO:** Interesting events. For example: a user performed SQL login or logs.
- **NOTICE:** Normal but significant events.
- **WARNING:** Exceptional occurrences, but not errors. For example: Use of deprecated APIs, inappropriate use of an API. In general things that are not wrong but need attention.
- **ERROR:** Runtime errors that do not require immediate action, but must be logged and monitored.
- **CRITICAL:** Critical conditions. For example: An application component is not available, an unexpected exception has occurred.
- **ALERT:** Immediate action must be taken. Example: System crashed, database is unavailable, etc. It should trigger an alert for the person in charge to take action as soon as possible.
- **EMERGENCY:** Emergency: The system is unusable.

## Usage

Solital uses the [monolog](https://packagist.org/packages/monolog/monolog) library to make use of logs. First, you need to enable logging in the `logger.yaml` file. Change the `enable_logs` variable to `true`.

```yaml
enable_logs: true
```

To use the log, use the `Logger::channel()` method, passing the channel to be used as a parameter.

```php
Logger::channel('single')->error('My info message');
```

The channel that will be used when calling this method will be defined within the `logger.yaml` file.

```yaml
channel:
  single: 
    type: stream
    path: log/logs.log
    level: debug

  main: 
    type: syslog
    path: log/syslogs.log
    level: error
```

By default, Solital uses the `single` channel. Therefore, do not remove this channel.

## Logger file

Taking a look at the `logger.yaml` file, we noticed some variables:

```yaml
# Channel name
single:
    # Log type
    type: stream
    # Log path
    path: log/logs.log
    # Log debug
    level: debug
```

## Processor

Processors are associated with log entry classes. They will inject information into entries'
context. You can use monolog processors.

To use [monolog processors](https://github.com/Seldaek/monolog/blob/HEAD/doc/02-handlers-formatters-processors.md#processors), add a variable called `processor` in your configuration file.

```yaml
mail: 
    type: mail
    path: email@email.com
    level: debug
    processor: [IntrospectionProcessor, MemoryUsageProcessor, WebProcessor]
```

## Customer handlers

By default, Solital offers two Monolog handlers. If you want to add one or several custom handlers, you can use the `customHandler()` method.

```php
$handler[] = new StreamHandler('path/to/log.log', Level::Debug);

Logger::customHandler('custom-channel', $handler)->debug('My info message');
```

If necessary, you can use the third parameter to use a processor.

```php
$handler[] = new StreamHandler('path/to/log.log', Level::Debug);
$processor = new IntrospectionProcessor();

Logger::customHandler('custom-channel', $handler, $processor)->debug('My info message');
```