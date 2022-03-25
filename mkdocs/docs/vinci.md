Vinci Console is an auxiliary component to help create files faster, such as login structures, password recovery structures, database configuration and more.

## Access Vinci

To access Vinci, open the terminal in your project folder and type `php vinci [command]`. To access information about Solital and its dependencies, open your terminal inside your project folder and type `php vinci version`

### For Windows

To run the Vinci console on Windows, remember to add the PHP directory to the Windows PATH. Also check if your version of Windows or your editor supports ANSI characters.

## List of all commands

The Vinci Console is a very simple to use helper. When you run the `php vinci list` command, you will get a description of all the commands present in the Solital Framework.

**Example**

```bash
php vinci [command] [argument] [--option1] [--option2]
```

| Command      | Description                             | Arguments           | Options   |
|--------------|-----------------------------------------|---------------------|-----------|
| `auth:skeleton` | Create Login and 'Forgot Password' structures | | --login / --forgot / --remove |
| `cache:clear` | Clear the Solital cache |  | --cache / --session |
| `create:cmd` | Create a command | name | --remove |
| `create:controller` | Create a Controller class | name | --remove |
| `create:middleware` | Create a Middleware class | name | --remove |
| `create:migration` | Create a migration | name (optional) | |
| `create:model`| Create a Model class | name | --remove |
| `create:queue`| Create a Queue class | name | --remove |
| `create:seeder` | Create a Seed class | name | |
| `db:dump` | Dump the connected database | name | |
| `generate:files` | Imports Solital Framework's default configuration files | | |
| `migrate` | Run a migration | | --rollback (=value) / --status |
| `queue` | Run a queue | | --class (=name) |
| `router:list` | Show all routes | | |
| `seeder`| Run a user-created Seeder | | --class (=name) |
| `version`| Check the Solital Framework version | | |
| `help`| Describes a command | cmd_name | |
| `about`| Displays the Vinci Console version | | |
| `list`| Displays a list of all Solital commands | | |

## Custom Command

To create a custom command, you need to run the command `php vinci create:cmd [command_name_class]`. This command will create a class in the `app/Console/Command` folder.

Below is an example of the command and the created class:

**Command**

```bash
php vinci create:cmd UserCommand
```

**Generated class**

```php
<?php

namespace Solital\Console\Command;

use Solital\Core\Console\{Command, MessageTrait};
use Solital\Core\Console\Interface\CommandInterface;

class UserCommand extends Command implements CommandInterface
{
    use MessageTrait;

    /**
     * @var string
     */
    protected string $command = "";

    /**
     * @var array
     */
    protected array $arguments = [];

    /**
     * @var string
     */
    protected string $description = "";

    /**
     * @param object $arguments
     * @param object $options
     * 
     * @return mixed
     */
    public function handle(object $arguments, object $options): mixed
    {
        return $this;
    }
}
```

In the `$command` variable, you will define the custom command that will be executed. The `$arguments` variable will have an array of values containing all arguments (if your custom command has no arguments, leave this variable empty). Lastly, the `$description` variable will have a short description of what the custom command does.

**Handle method**

The handle method will contain all the code that will be executed when executing the custom command and should always return a `$this` or, if necessary, another value.

**Using Arguments**

Arguments can be retrieved using the `$arguments` variable:

```bash
php vinci user:cmd myArgument
```

```php
/**
 * @param object $arguments
 * @param object $options
 * 
 * @return mixed
 */
public function handle(object $arguments, object $options): mixed
{
    var_dump($arguments->myArgument);

    return $this;
}
```

**Using Options**

Options are not defined in the created class, but you can check inside the `handle` method if an option exists. For example:

```bash
php vinci user:cmd myArgument --myOption
```

```php
/**
 * @param object $arguments
 * @param object $options
 * 
 * @return mixed
 */
public function handle(object $arguments, object $options): mixed
{
    if (isset($options->myOption)) {
        # ...
    }

    return $this;
}
```

## Input and output commands

It is very common to enter an input value on the command line when needed. Using the `InputOutput` class, you can perform this action.

```php
use Solital\Core\Console\InputOutput;

(new InputOutput())->dialog('Enter a string: ')->action(function ($message) {
    echo $message . PHP_EOL;
});
```

The `dialog()` method will display a message to the user, while the `action()` method retrieves the value entered on the command line. The `action()` method takes an anonymous function as a parameter.

**Confirmation box**

You can also use a "yes/no" confirmation, or any other value.

```php
use Solital\Core\Console\InputOutput;

(new InputOutput())->confirmDialog('What you want?', 'Y', 'N', false)->confirm(function () {
    echo "accepted" . PHP_EOL;
})->refuse(function () {
    echo "denied" . PHP_EOL;
});
```

In the first parameter of the `confirmDialog` method, you will define the question. The second parameter will be the value of the answer if it is positive, if not, the third parameter will receive the value of the answer if it is negative. The fourth parameter will define if the answer is know sensitive, if not, set it to `false`.

## Displaying messages

To display a message on the command line, use the `MessageTrait` trait. First, you will define a message using one of the methods below:

```php
use Solital\Core\Console\MessageTrait;

$this->success()    // Display a success message
$this->info()       // Display an information message
$this->warning()    // Displays a warning message
$this->error()      // Displays an error message
$this->line()       // Display a standard message
```

After that, to display the message on the command line, use the `print()` method:

```php
$this->success("My message")->print();
```

There are still other methods to complement your message. The `break()` method skips a line, while the `exit()` method stops code execution.

```php
// Skip a line
$this->success("My message")->print()->break()->exit();

// Skip two lines
$this->success("My message")->print()->break(true)->exit();
```

## Registering a custom command

When creating your custom command, it will not yet be ready to run. First, you need to configure the `Config.php` file. You can find this file in `app/Console`.

In the `$command_class` variable, you will define your class name like this:

```php
use Solital\Console\Command\UserCommand;

/**
 * @var array
 */
protected array $command_class = [
    UserCommand::class
];
```

You can register more than one command, and then add your new commands to this variable.

After that, you can run the created command using `php vinci user:cmd` or any other command you have defined.