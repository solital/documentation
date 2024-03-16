PHP's new feature Fibers allows for easier creation of asynchronous applications, and a key component of designing such an application is the event loop. The event loop is responsible for monitoring external resources for interesting events such as new input data or state changes. Once an event is detected, the event loop will resume the fibers that are interested in that event so they can process it. There are many ways to implement such a loop, ranging from a trivial sleep and resume to a complex, multifeatured event monitoring system. In this article, we'll look at a few examples and build up on the complexity as we go.

Below is an example of how to use EventLoop in your project:

```php
$loop = container('solital-eventloop');

// Or: new Solital\Core\Queue\EventLoop();

$loop->defer(function() use ($loop){
    $loop->sleep(0.2);

    foreach (range(1, 5) as $value) {
        echo $value;
        $loop->next();
    }
});

$loop->defer(function() use ($loop){
    foreach (range(1, 10) as $value) {
        echo $value;
        $loop->next();
    }
});

$loop->deferWithTimer(0.5, function() use ($loop){
    foreach (range(1, 10) as $value) {
        echo $value;
        $loop->next();
    }
});

$loop->run();
```