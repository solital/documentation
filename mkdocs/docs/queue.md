Queues in Solital are easy to use. First, you'll need to create them using the Vinci Console:

```bash
php vinci create:queue UserQueue
```

The queues will be stored inside the `app/Queue` folder. The structure that will be created is similar to this:

```php
<?php

class UserQueue
{
    public function dispatch()
    {
        # ...
    }    
}
```

All code must be added in the `dispatch()` method

## Running a queue

To run a queue, you will need to run the command:

```bash
php vinci queue
```

This command will run all queues you have created. Some queues that Solital creates will also run. You can run a specific queue. For that, use the `--class` option.

```bash
php vinci queue --class=UserQueue
```