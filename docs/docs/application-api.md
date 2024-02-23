Solital has a class called `Application`. This class, which is in the `Kernel` folder, manages the entire framework, from the instances to start the framework to communication with the database.

Most of the methods in this class are for internal use by the framework. However, you can make use of some methods in this class.

## YAML files

To retrieve variables from a YAML file, use the `yamlParse` method.

```php
Application::yamlParse('file.yaml');
```

## Dependency Container

To use the container defined in `ServiceContainer` class, use `provider` method.

```php
Application::provider('container_name');
```

## Access root folder

If you want to access a folder in the project root, use the `getRoot` method, and `getRootApp` to access a folder in `app/`.

```php
Application::getRoot('/folder_name');

Application::getRootApp('/folder_name_in_app');
```

The `getRootApp` method will create a folder inside the `app/` folder if the folder you want to access doesn't exist. To disable the creation of this folder, use `false` in the second parameter.

```php
Application::getRootApp('/folder_name_in_app', false);
```

## Autoload PHP files

Recursively loads all php files in all subdirectories of the given path.

```php
Application::autoload('folder/');

Application::classLoaderInDirectory('folder/');
```

## Is CLI

Checks whether PHP is running in CLI mode or not.

```php
Application::isCli();
```

## Database

To use the database connection, you can use the `connectionDatabase` method. This method makes use of the variables defined in the `.env` file or, if you use a test database, in the `database.yaml`.

```php
Application::connectionDatabase();
```

This method also makes use of Solital's cache, if you are using it.