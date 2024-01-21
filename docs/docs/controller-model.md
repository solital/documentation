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

## Creating model and controller with one command

Solital has a command to generate model and controller with just one command:

```bash
php vinci generate:files User --component
```

Remember to use the `--component` option. This command will create a Model class, a Controller class, a migration and a Seeder class.