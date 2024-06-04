## Introduction

The model is responsible for the abstraction of the database. Therefore, all methods that will access the database for modifications or returns must be developed in the model.

In the controller we just call our model, which is the class responsible for the abstraction. When we retrieve the data, we send it to our vision.

To create a model and a controller, you must use the following commands:

```bash
# Create a Model
php vinci create:model User

# Create a controller
php vinci create:controller UserController
```

You can use the `--remove` option to remove a model or controller

## Using controller in the route

To use a controller on any route you create within the `routers/` folder, you must use the following syntax:

```php
Course::get('/', 'UserController@home')->name('forgot');
```

The name after the `@` will be the name of the method to be called. For example, you must have the `home` method inside your `UserController` controller.

You can load the entire controller (where url matches method names - getIndex(), postIndex(), putIndex()).
The url paths will determine which method to render. For example:

| Router                  | Method     |
|-------------------------|------------|
| **GET  /animals**       | getIndex() |
| **GET  /animals/view**  | getView()  |
| **POST /animals/save**  | postSave() |

To do this, use the `controller` method.

```php
Course::controller('/animals', ControllerAnimals::class);
```

## Creating model and controller with one command

Solital has a command to generate model and controller with just one command:

```bash
php vinci generate:files --component=User
```

Remember to use the `--component` option. This command will create a Model class, a Controller class, a migration and a Seeder class.

## Creating a resource

We often use a controller to do CRUD() operations. To create a controller in resource format, use the `--resource` option.

```bash
php vinci create:controller ResourceController --resource
``` 

When creating a resource type controller, the class will have the following structure:

```php
<?php

class ResourceController
{
    public function index() : ?string
    {
        echo 'index';
        return null;
    }

    public function show($id) : ?string
    {
        echo 'show ' . $id;
        return null;
    }

    public function store() : ?string
    {
        echo 'store';
        return null;
    }

    public function create() : ?string
    {
        echo 'create';
        return null;
    }

    public function edit($id) : ?string
    {
        echo 'edit ' . $id;
        return null;
    }

    public function update($id) : ?string
    {
        echo 'update ' . $id;
        return null;
    }

    public function destroy($id) : ?string
    {
        echo 'destroy ' . $id;
        return null;
    }
}
```

You can use this resource on a specific route with the `resource()` method.

```php
Course::resource('/resource', ResourceController::class);
```

## Helpers for controllers

Solital has some helpers for you to use in your controllers. The helpers below have methods that should only be used in controllers.

### Password

You can use password helpers, or use the `passHash` and `passVerify` methods.

**Password hash**

```php
pass_hash($password, int $cost = 10)

# With method on Controller
$this->passHash($password, $info = false)
```

**Password verify**

```php
pass_verify($password, string $hash)

# With method on Controller
$this->passVerify($password, $hash)
```

### Request

You have the option to limit the number of requests in a controller, and also check if a value has already been sent previously. 

**Request limit**

```php
request_limit(string $key, int $limit = 5, int $seconds = 60)

# With method on Controller
$this->requestLimit(string $key, int $limit = 5, int $seconds = 60)
```

**Request repeat**

```php
request_repeat(string $key, string $value)

# With method on Controller
$this->requestRepeat(string $key, string $value)
```

**Redirect to another router**

```php
to_route(string $url, ?int $code = null)

# Or, use a method on Controller
$this->redirect(string $url, ?int $code = null)
```

**Remove params from URL**

```php
remove_param()

# With method on Controller
$this->removeParamsUrl()
```

**Get input-parameters**

```php
input(string $index = null, string $defaultValue = null, ...$methods)

# With method on Controller
$this->getRequestParams(string $index = null, string $defaultValue = null, ...$methods)
```