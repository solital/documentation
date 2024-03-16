## Introduction

Injecting dependencies can become a tedious task when many classes are involved. Before injecting a dependency it needs to be instantiated. So, we don't just take care of the "injection", we also need to have the knowledge of what objects it needs to work.

A dependency injection container (DI Container) manages and automates instantiations. We tell him how an object should be created (this is the part that touches us, our knowledge about it) and then whenever we need it, we just need to use the container to obtain it. 

Solital implements the PSR-11, meaning you can easily create dependency containers.

Consider this example:

```php
<?php

class UserManager
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new Mailer();
        $this->mailer->setTransport('sendmail');
    }
    
    public function setMailerTransport($transport)
    {
        $this->mailer->setTransport($transport);
    }
}
```

Here we have our ``UserManager`` service that is responsible for creating its ``Mailer`` dependency via setter injection. If we decide to later change the type of mailer that is used, and that mailer uses constructor injection rather than setter injection, we must alter our ``UserManager`` code, potentially breaking other methods that may use the ``setTransport`` method.

Instead, the ``UserManager`` service should simply ask for a Mailer object, and get one. It should not care how it is created or what methods the mailer uses to configure itself, it just asks for one and receives one:

```php
class UserManager
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
}
```

The configuration of the mailer is now setup outside of the ``UserManager``, and will not break anything if it is changed. So that leaves us with a question: Where should we write this "wiring" or configuration of the dependencies?

That's where the container concept comes in. An IoC, or dependency injection container is the place where you would write up how your services should be created. Going back to the above example:

```php
$container->add('userManager', function($container) {
    $mailer = $container->get('mailer');
    
    return new UserManager($mailer);
});

$container->add('mailer', function() {
    $transport = 'gmail';
    $mailer = new Mailer($transport);
});
```

Now all we have to do is ask for the ``UserManager``, and its ``Mailer`` dependency will be created for us. If we decide to change the transport methodback to sendmail at any point, all we have to do is change it in one place in the service configuration area.

### Usage

Service container are a way to organize your container entries. Service container are nothing more than classes that implement the ``ServiceProvider`` interface that exposes a ``register`` method. The ``register`` method is always passed an instance of the container.

For example, lets say that you have a suite of services that deal with user management. You could organize them into a single service provider class/file called ``UserServiceProvider``. This class would then be responsible for adding all container entries related to user management.

To use dependency injection, you must register your containers within the `register` method located in the `ServiceContainer` class located in the `app/` folder.

```php
<?php

namespace Solital;

use Solital\Core\Container\Interface\ContainerInterface;
use Solital\Core\Container\Interface\ServiceProviderInterface;

class ServiceContainer implements ServiceProviderInterface
{
    public function register(ContainerInterface $container)
    {
        $container->add('userManager', function($container) {
            $mailer = $container->get('mailer');
            
            return new UserManager($mailer);
        });

        $container->add('mailer', function() {
            $transport = 'gmail';
            $mailer = new Mailer($transport);
        });
    }
}
```

To use the container, use `container()` helper, `Application::provider()` or `$container->get()` method:

```php
$provider = container('mailer');
$provider = $container->get('mailer');
$provider = Application::provider('mailer');

var_dump($provider);
```

### Adding Definitions

**Services** are defined by invokable callback functions. Most commonly, this is a closure (anonymous function) that explains how to create a service:

```php
$myServiceDefinition = function() {
    $obj = new Service();
    
    return $obj;
};
```

**Parameters** are simple primitive values that should be accessed throughout your application. It is assumed that your entry is a parameter if it is not an invokable function.

To add a service or parameter to the container, use the ``Container::add`` method.

```php
$container = new Container();

$container->add('myParameter', 'value');
$container->add('myService', function() {
    return new MyService();
});
```

The container can also be accessed like an array. So adding entries is as easy as using array notation:

```php
$container['myParameter'] = 'value';
$container['myService'] = function() {
    return new MyService();
};
```

When defining services, note that an instance of the container is always passed as an argument to the invokable callback. This allows you to resolve nested dependencies. In our synopsis, we used the example of a ``UserManager`` service who needed a ``Mailer`` object. We can define how to create the mailer in one entry, and how to create the user manager in a separate entry like this:

```php
$container['userManager'] = function($container) {
    // The user manager needs a mailer, so get that from the container first
    $mailer = $container->get('mailer');
    
    // Now pass that to the UserManager
    return new UserManager($mailer);
};

$container['mailer'] = function() {
    return new Mailer();
};

$userManager = container('userManager');
```

This is known as manually wiring your dependencies.

### Retrieving Services and Parameters

Once an entry is added to the container, we can resolve that entry by using the ``Container::get`` method, or via array access:

```php
$container['myParameter'] = 'value';
$myParameter = container('myParameter');

var_dump($myParameter); // outputs: 'value'

$container['myService'] = function() {
    return new MyService();
};

$myService = $container['myService'];
var_dump($myService instanceof MyService::class); // outputs: true
```

Note that the service definition is executed and the result of the callback is what is assigned to ``$myService``, rather than the literal callback function. If you would like a callback function to be interpreted as a literal value, you can use the ``Container::protect`` method:

```php
$container->add('myService', $container->protect(function() {
    return new MyService();
}));
$myServiceFactory = container('myService');

var_dump($myServiceFactory instanceof \Closure); // outputs: true
```

By default, when the container resolves a service entry, that service will be "shared" across the life of the container. This means that when the container is asked for the service a second time, the **same** instance will be returned as the first. This is often times the desired behavior when dealing with database connections, mailers, and logger objects.

It would be a waste of memory to create these types of objects multiple times. You would not want 20 different database connections open at the same time if you really only need one:

```php
$container->add('db', function() {
    ... // database configuration
    return new PDO();
});
    
$db = container('db');
$db2 = container('db');

var_dump($db === $db2); // outputs: true
```

However, sometimes you do need to get a new instance of a service each time it is accessed. For those cases, simply define the service as a **factory** with ``Container::factory``:

```php
$container->add('myService', $container->factory(function() {
    return new MyService();
}));

$myService = container('myService');
$myService2 = container('myService');

var_dump($myService === $myService2); // outputs: false
```

## Extending Definitions

Often times you need to modify a service after it has been created. This is often times called "setter injection" or "decorating". This can be achieved by using the ``Container::extend`` method. The extend method is passed the instance of the object and an instance of the container in that order. 

An extend will fail if:

  - The entry does not exist
  - The entry is a parameter
  - The entry is currently being resolved
  - The entry is protected
  - The extend callback is not invokable

Therefore, extending is meant to be done on existing service definitions only:

```php
$container['mailer'] = function() {
    return new Mailer();
};

$container->extend('mailer', function($mailer, $container) {
    $mailer->setTransport('sendmail');
    $mailer->setUsername($container->get(...));
});
```

If, however, you leave the second argument empty and only assign an invokable callback, like so:

```php
$container->extend(function() {});
```

This will be treated as a global callback function that should be run on every resolve. This is also a cool way to see how inversion of control works. We can assign a callback to run whenever the container resolves any type of entry, and get some feedback about what it is creating.

A great example of dependency injection comes from the [Auryn](https://github.com/rdlowrey/auryn#recursive-dependency-instantiation) container docs:

```php
class Car
{
    private $engine;

    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }
}

class Engine
{
    private $sparkPlug;
    private $piston;

    public function __construct(SparkPlug $sparkPlug, Piston $piston)
    {
        $this->sparkPlug = $sparkPlug;
        $this->piston = $piston;
    }
}
```

As you can see we have a ``Car`` object that depends on an ``Engine`` object, and the ``Engine`` object depends on its own service objects ``SparkPlug`` and ``Piston``. Using a normal object creation workflow, the wiring of these objects would look something like this:

* Application needs Car
* Car needs Engine so:
    * Engine needs SparkPlug and Piston so:
        * Engine creates SparkPlug
        * Engine creates Piston
    * Car creates engine
* Application creates Car

However the wiring of objects using inversion of control looks like this:

* Application needs Car, which needs Engine, which needs SparkPlug and Piston so:
* Application creates SparkPlug and Piston
* Application creates Engine and gives it SparkPlug and Piston
* Application creates Car and gives it Engine

You can see that the difference with inversion of control is that application (container) creates the dependencies in an inverted fashion, creating the lowest level dependencies first, and passing them up through the chain of services. This ensures that none of the services know how their dependencies are created, and that they are loosely coupled.

We can have a look at this in action with something like this:

```php
// Create something to run on every resolve
$container->extend(function($resolved, $container) {
    echo is_object($resolved) ? get_class($resolved) . ' created.<br />' : '';
});

// Define our services
$container['sparkPlug'] = function() { 
    return new SparkPlug(); 
};
$container['piston'] = function() { 
    return new Piston(); 
};
$container['engine'] = function($c) {
    return new Engine($c['sparkPlug'], $c['piston']);
};
$container['car'] = function($c) { 
    return new Car($c['engine']); 
};

// Get our service
$container->get('car');
```

This would then output the following:

```
SparkPlug created.
Piston created.
Engine created.
Car created.
```

This is proof that the container uses the inversion of control principle since the global callback function gets called after each resolve.