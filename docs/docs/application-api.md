Solital has a class called `Application`. This class, which is in the `Kernel` folder, manages the entire framework, from the instances to start the framework to communication with the database.

Most of the methods in this class are for internal use by the framework. However, you can make use of some methods in this class.

You can use the `Application` class or the helpers of that class.

## YAML files

Returns variables by YAML file.

```php
// With class
Application::yamlParse('file.yaml');

// With helper
app_get_yaml('file.yaml');
```

Add a value to a YAML file

```php
// With class
Application::addYamlValue('file.yaml', 'key', 'value');

// With helper
app_add_yaml('file.yaml', 'key', 'value');
```

## Dependency Container

Get container ID defined in `ServiceContainer` class.

```php
// With class
Application::provider('container_name');

// With helper
container('container_name');
```

## Access root folder

Return directory on root folder

```php
// With class
Application::getRoot('/folder_name');

// With helper
app_get_root('/folder_name');
```

## Access "app" folder

Return directory in `app/` folder

```php
// With class
Application::getRootApp('/folder_name_in_app');

// With helper
app_get_app('/folder_name_in_app');
```

The `getRootApp` method will create a folder inside the `app/` folder if the folder you want to access doesn't exist. To disable the creation of this folder, use `false` in the second parameter.

```php
// With class
Application::getRootApp('/folder_name_in_app', false);

// With helper
app_get_app('/folder_name_in_app', false);
```

## Autoload PHP files

Recursively loads all php files in all subdirectories of the given path.

```php
// With class
Application::autoload('folder/');
Application::classLoaderInDirectory('folder/');

// With helper
app_autoload('folder/');
app_classloader('folder/');
```

## Is CLI

Checks whether PHP is running in CLI mode or not.

```php
// With class
Application::isCli();

// With helper
app_is_cli();
```

## Database

Get Solital's database connection. This method makes use of the variables defined in the `.env` file or, if you use a test database, in the `database.yaml`.

This method also makes use of Solital's cache, if you are using it.

```php
// With class
Application::connectionDatabase();

// With helper
app_get_database_connection();
```