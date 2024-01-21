## Introduction

Queues are an important solution, especially when need to create a processing task that may take a long time to complete and the user or the creating process cannot wait until the task is finished. This is the case for instance of sending newsletter email messages to many users.

## Usage

The Queue component makes use of PHP 8.1 Fibers. As a result, queues are executed asynchronously.

To create a queue, execute this command:

```bash
php vinci create:queue UserQueue
```

The queues will be stored inside the `app/Queue` folder. The structure that will be created is similar to this:

```php
<?php

use Solital\Core\Queue\Queue;

class UserQueue extends Queue
{
    protected float $sleep = 1;

    public function dispatch()
    {
        # ...
    }    
}
```

All code must be added in the `dispatch()` method.

## Queue waiting time

If you have code that takes a long time to execute, such as sending an email, you can set the waiting time by changing the value of the `$sleep` property.

```php
protected float $sleep = 5.3;
```

With this, the Queue component will wait while executing other queues that you have created.

## Running a queue

To run a queue, you will need to run the command:

```bash
php vinci queue
```

This command will run all queues you have created. Some queues that Solital creates will also run. You can run a specific queue. For that, use the `--class` option.

```bash
php vinci queue --class=UserQueue
```