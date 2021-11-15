## Introduction

Injecting dependencies can become a tedious task when many classes are involved. Before injecting a dependency it needs to be instantiated. So, we don't just take care of the "injection", we also need to have the knowledge of what objects it needs to work.

A dependency injection container (DI Container) manages and automates instantiations. We tell him how an object should be created (this is the part that touches us, our knowledge about it) and then whenever we need it, we just need to use the container to obtain it. 

Solital implements the PSR-11, meaning you can easily create dependency containers. By default, if your controller extends from `Controller`, you only need to use `$this->container->get()` and `$this->container->set()`. Otherwise, it is necessary to make the instance of the `Container` class. 

```php
use Solital\Core\Course\Container\Container;

$container = new Container();
```

## How to use

The `set()` method sets a dependency function for an identifier that returns the dependency. Subsequent calls to the identifier return the first returned value of the function. `$id` is the identifier of the entry to look for, `$function` is the function whose return value will be attached to the identifier on subsequent `get()` calls.

```php
$this->container->set($id, $function);
```

The example below shows exactly how you should create your dependency container. 

```php
# The `UserModel` instance is just an example

$this->container->set('user', function() {
    return new UserModel();
});
```

## Return a container

To return a container, use the `get()` method by passing the dependency identifier as a parameter. 

```php
$dep = $this->container->get('user');

# The `run` method is just an example of the fictional `UserModel` class. 
$res = $dep->run();
pre($res);
```

You can check if a container exists using the `has()` method. Returns true if the container can return an entry for the given identifier. Otherwise, it returns false.

```php
$this->container->get('user');
$dep = $this->container->has('user');

/** Return bool */
pre($dep);
```

`has($id)` returning true does not mean that `get($id)` will not throw an exception. However, this means that `get($id)` will not throw a `NotFoundException`. 

## Using arguments in the constructor

If you need to use any arguments in your class's constructor, you can use the third parameter of the `set()` method. 

```php
# The `UserModel` instance is just an example

$this->container->set('user', function($args) {
    return new UserModel($args);
}, 'Brenno Duarte');
```

You can use arguments as an array:

```php
# The `UserModel` instance is just an example

$array_args = ['arg1', 'arg2', 'arg3'];

$this->container->set('user', function($args) {
    return new UserModel($args);
}, $array_args);
```

## Example

Below is an example of how the dependency container should be used: 

```php
<?php

namespace Solital\Components\Controller;

use Solital\Components\Controller\Controller;
use Solital\Components\Model\UserModel;
use Solital\Components\Model\ContactModel;

class UserController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->container->set("user", function() {
            return new UserModel();
        });
    }

    /**
     * @return void
     */
    public function call1(): void
    {
        $dep = $this->container->get('user');
        $dep->run();
    }

    /**
     * @return void
     */
    public function call2()
    {
        $dep = $this->container->get('user');
        $dep->run();
    }
}
```