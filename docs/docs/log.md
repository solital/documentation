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

Create the logger instance with a channel id,

```php
use Psr\Log\LogLevel;
use Solital\Core\Logger\Logger;
use Solital\Core\Logger\Entry\MemoryInfo;
use Solital\Core\Logger\Handler\SyslogHandler;
use Solital\Core\Logger\Handler\TerminalHandler;

// with channel id
$logger = new Logger('MyApp');

// log every warning to syslog
$logger->addHandler(
    LogLevel::WARNING,
    new SyslogHandler()
);

// log to terminal for MemoryInfo entry
$logger->addHandler(
    LogLevel::INFO,
    new TerminalHandler(),
    MemoryInfo::class // handle this log object only
);

// log a text message
$logger->warning('a warning message');

// log memory usage
$logger->info(new MemoryInfo());
```

## Concepts

- **Log entry**

*A log entry* is a message in the form of an object. It solves the problem
of **'WHAT TO BE SENT OUT'**. It has a message template, and some processors
to process its context.

For example, `Entry\MemoryInfo` is a predefined log entry with a message
template of `{memory_used}M memory used , peak usage is {memory_peak}M`
and one `Processor\MemoryProcessor` processor.

```php
// with predefined template and processor
$logger->warning(new MemoryInfo());

// use new template
$logger->warning(new MemoryInfo('Peak memory usage is {memory_peak}M'));
```

`Entry\LogEntry` is the log entry prototype used whenever text message is
to be logged

```php
// using LogEntry
$logger->info('test only');
```

To define your own log entry,

```php
use Solital\Core\Logger\Entry\LogEntry;

class MyMessage extends LogEntry
{
    // message template
    protected $message = 'your {template}';
}

// add handler
$logger->addHandler(
    'warning', // level
    function(LogEntry $entry) { // a handler
        echo (string) $entry;
    },
    MyMessage::class // handle this type of message only
);

// output: 'your wow'
$logger->error(new MyMessage(), ['template' => 'wow']);
```

- **Processor**

*Processors* are associated with log entry classes. They solve the problem of
**'WHAT EXTRA INFO TO SENT OUT'**. They will inject information into entries'
context. Processors are `callable(LogEntryInterface $entry)`,

```php
use Solital\Core\Logger\Processor\ProcessorAbstract;

// closure
$processor1 = function(LogEntry $entry) {
};

// invokable object
$processor2 = new class() {
    public function __invoke(LogEntry $entry)
    {
    }
}

// extends
class Processor3 extends ProcessorAbstract
{
    protected function updateContext(array $context): array
    {
        $context['bingo'] = 'wow';
        return $context;
    }
} 
```

Processors are attached to log entries either in the entry class definition
as follows,

```php
class MyMessage extends LogEntry
{
    // message template
    protected $message = 'your {template}';
    
    // define processors for this class
    protected static function classProcessors(): array
    {
        return [
            function(LogEntry $entry) {
                $context = $entry->getContext();
                $context['template'] = 'wow';
                $entry->setContext($context);
            },
            new myProcessor(),
        ];
    }
}
```

or during the handler attachment

```php
use Solital\Core\Logger\Handler\SyslogHandler;

// will also add 'Processor1' and 'Processor2' to 'MyMessage' class
$logger->addHandler(
    'info',
    new SyslogHandler(),
    MyMessage::addProcessor(
        new Processor1(),
        new Processor2(),
        ...
    )
);
```

- **Handler**

*Handlers* solve the problem of **'WHERE TO SEND MESSAGE'**. They take a
log entry object and send it to somewhere.

Handlers takes the form of `callable(LogEntryInterface $entry)` as follows,

```php
use Solital\Core\Logger\Handler\HandlerAbstract;

$handler1 = function(LogEntry $entry) {
    echo (string) $entry;
}

$handler2 = new class() {
    public function __invoke(LogEntry $entry)
    {
    }
}

class Handler3 extends HandlerAbstract
{
    protected function write(LogEntryInterface $entry)
    {
        echo $this->>getFormatter()->format($entry);
    }
}
```

Handlers are added to the `$logger` with specific log level and type of
log message they are going to handle (default is `LogEntryInterface`).

```php
$logger->addHandler(
    LogLevel::WARNING,
    new TerminalHandler(),
    LogEntryInterface::class // this is the default anyway
);
```

- **Formatter**

*Formatters* solve the problem of **'HOW MESSAGE WILL BE PRESENTED''**.
Each handler of the type `Handler\HandlerAbstract` may have formatter
specified during its initiation.

```php
use Solital\Core\Logger\Handler\TerminalHandler;
use Solital\Core\Logger\Formatter\AnsiFormatter;

// use ANSI Color formatter
$handler = new TerminalHandler(new AnsiFormatter());

// add handler handles 'ConsoleMessage' ONLY
$logger->addHandler('debug', $handler, ConsoleMessage::class);

// log to console
$logger->info(new ConsoleMessage('exited with error.'));

// this will goes handlers handling 'LogEntry'
$logger->info('exited with error');
```

APIs
---

- `LoggerInterface` related

See [PSR-3][PSR-3] for standard related APIs.

- `Solital\Core\Logger\Logger` related

- `__construct(string $channel)`

Create the logger with a channel id.

- `addHandler(string $level, callable $handler, string $entryClass, int $priority = 50): $this`

Add one handler to specified channel with the priority.

- `Solital\Core\Logger\Entry\LogEntry` related

- `static function addProcessor(callable ...$callables): string`

This method will returns called class name.

## Auto log

Solital generates a log file whenever a critical system error occurs. Log files are stored in `app/Storage/log/`.

To disable the creation of these files, open the `bootstrap.yaml` file and change the `enabled_log_files` key to `false`:

```yaml
logs:
  enabled_log_files: false
```