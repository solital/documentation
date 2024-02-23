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

<table class="table">
  <thead>
    <tr>
      <th scope="col">Command</th>
      <th scope="col">Description</th>
      <th scope="col">Arguments</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="cmd-vinci">auth:skeleton</span></td>
      <td>Create Login and 'Forgot Password' structures</td>
      <td>-</td>
      <td>--login / --forgot / --remove</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">create:cmd</span></td>
      <td>Create a command</td>
      <td>name</td>
      <td>--remove</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">create:controller</span></td>
      <td>Create a Controller class</td>
      <td>name</td>
      <td>--remove</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">create:middleware</span></td>
      <td>Create a Middleware class</td>
      <td>name</td>
      <td>--remove</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">create:migration</span></td>
      <td>Create a migration</td>
      <td>name (optional)</td>
      <td>-</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">create:model</span></td>
      <td>Create a Model class</td>
      <td>name</td>
      <td>--remove</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">create:queue</span></td>
      <td>Create a Queue class</td>
      <td>name</td>
      <td>--remove</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">create:seeder</span></td>
      <td>Create a Seeder class</td>
      <td>name</td>
      <td>-</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">create:router</span></td>
      <td>Create a new router</td>
      <td>name</td>
      <td>--comment</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">db:dump</span></td>
      <td>Dump the connected database</td>
      <td>name</td>
      <td>-</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">db:list</span></td>
      <td>List data from a database table</td>
      <td>-</td>
      <td>--limit=10</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">generate:files</span></td>
      <td>Imports Solital Framework's default configuration files</td>
      <td>-</td>
      <td>-</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">migrate</span></td>
      <td>Run a migration</td>
      <td>-</td>
      <td>--rollback (=value) / --status</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">queue</span></td>
      <td>Run a queue</td>
      <td>-</td>
      <td>--class (=name)</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">router:list</span></td>
      <td>Show all routes</td>
      <td>-</td>
      <td>-</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">scanner</span></td>
      <td>Find infected files</td>
      <td>-</td>
      <td>-</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">schedule</span></td>
      <td>Create a schedule class</td>
      <td>name</td>
      <td>-</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">seeder</span></td>
      <td>Run a user-created Seeder</td>
      <td>-</td>
      <td>--class (=name)</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">server</span></td>
      <td>Start built-in PHP server</td>
      <td>-</td>
      <td>-</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">status</span></td>
      <td>Check app status</td>
      <td>-</td>
      <td></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">storage:clear</span></td>
      <td>Clear the Solital cache</td>
      <td>-</td>
      <td>--cache / --session / --schedules / --log</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">version</span></td>
      <td>Describes a command</td>
      <td>cmd_name</td>
      <td>-</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">help</span></td>
      <td>Displays details about some command</td>
      <td>-</td>
      <td>-</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">about</span></td>
      <td>Displays the Vinci Console version</td>
      <td>-</td>
      <td></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">list</span></td>
      <td>Displays a list of all Solital commands</td>
      <td>-</td>
      <td>-</td>
    </tr>
  </tbody>
</table>

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
	 * @var array
	 */
	protected array $options = [];

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

In the `$command` variable, you will define the custom command that will be executed. The `$arguments` variable will have an array of values containing all arguments (if your custom command has no arguments, leave this variable empty). The variable `$options` must contain mandatory options for your command, otherwise use the options dynamically. Lastly, the `$description` variable will have a short description of what the custom command does.

The handle method will contain all the code that will be executed when executing the custom command and should always return a `$this` or, if necessary, another value.

**Using Arguments**

Arguments can be retrieved using the `$arguments` variable:

```bash
php vinci user:cmd myArgument
```

```php
protected array $arguments = ['name'];
```

If you pass more arguments than are specified in your command's class, a warning will be displayed.

**Using Options**

Options can be returned dynamically, but you must check in the `handle` method whether an option exists.

```bash
php vinci user:cmd name --myOption
```

```php
public function handle(object $arguments, object $options): mixed
{
    if (isset($options->myOption)) {
        # ...
    }

    return $this;
}
```

If you have any mandatory options that must be entered when executing the command, you can define these options using the variable `$options`.

```php
protected array $options = ['--myoption', '--withArg='];
```

In the example above, the command must contain one of the options. If an option requires entering a value, use `=` next to the option (see the example above: `--withArg=`).

This will mean that when using this option, the user will enter a value (for example: `--withArg=accept`).

## Input and output commands

It is very common to enter an input value on the command line when needed. Using the `InputOutput` class, you can perform this action.

```php
use Solital\Core\Console\InputOutput;

$input_output = new InputOutput();
$input_output->dialog('Enter a string: ')->action(function ($message) {
    echo $message . PHP_EOL;
});
```

The `dialog()` method will display a message to the user, while the `action()` method retrieves the value entered on the command line. The `action()` method takes an anonymous function as a parameter.

**Confirmation box**

You can also use a "yes/no" confirmation, or any other value.

```php
use Solital\Core\Console\InputOutput;

$input_output = new InputOutput();
$input_output->confirmDialog('What you want?', 'Y', 'N', false)->confirm(function () {
    echo "accepted" . PHP_EOL;
})->refuse(function () {
    echo "denied" . PHP_EOL;
});
```

In the first parameter of the `confirmDialog` method, you will define the question. The second parameter will be the value of the answer if it is positive, if not, the third parameter will receive the value of the answer if it is negative. The fourth parameter will define if the answer is know sensitive, if not, set it to `false`.

**Customizing colors**

To customize the colors of the message that is displayed from the CLI, you can pass the color name in the constructor of the `InputOutput` class.

The available colors are: `green`, `yellow` and `blue`.

```php
$input_output = new InputOutput('green'); // green - yellow - blue
```

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

## Progress Bar

Progressbar has customizable names, colors, datatypes, error handling, and more.

**Usage**

```php
use Solital\Core\Console\ProgressBar\ProgressBar;
use Solital\Core\Console\ProgressBar\ProgressBarStyle;

//Lets create a style object first.
//Style object has 4 parameters {$name, $color, $datatype, $length}.

$progressbar_style = new ProgressBarStyle("Downloading", "white", "Kb", 16);

//Now lets create the progressbar object.
//Progressbar object has 2 parameters {$styleobject, $initialmax}

$progressbar = new ProgressBar($progressbar_style, 1000);
```
Using the Progressbar

```php
//Loop until the progressbar is complete

for ($i = 0; $i < $progressbar->GetInitialMax(); $i++) {
    $progressbar->step();
    usleep(1000);
}
```

**Methods**

```php
//Increases the progressbar value by 1.
$progressbar->step();

//Increases the progressbar value by x.
$progressbar->stepBy(x);

//Changes the progressbar value to x.
$progressbar->stepTo(x);

//Gets the progressbar value.
$progressbar->getValue();

//Gets the max initial value.
$progressbar->getInitialMax();

//Forces a redraw on the progressbar.
$progressbar->update();

//Enables the pause mode, it can be removed by using any of the step methods or forcing a redraw.
$progressbar->pauseProgressbar();

//Resets the progressbar object.
$progressbar->resetProgressbar();

//Terminates the progressbar and resets the object.
$progressbar->terminateProgressbar();
```

## Table

You can create tables in the console. To do this, use the `Table` class. 

```php
use Solital\Core\Console\Table;

$table = new Table();

$table->row([
    'id'        => 1,
    'name'      => 'Matthew S.',
    'surname'   => 'Kramer',
    'email'     => 'matthew@example.com',
    'status'    => true,
]);

$table->row([
    'id'        => 2,
    'name'      => 'Millie J.',
    'surname'   => 'Koenig',
    'email'     => 'millie@example.com',
    'status'    => false,
]);

$table->row([
    'id'        => 3,
    'name'      => 'Regina G.',
    'surname'   => 'Hart',
    'email'     => 'regina@example.com',
    'status'    => true,
]);

echo $table;
```

Output : 

<img src="https://user-images.githubusercontent.com/104234499/186993361-3917979a-0a40-4e7b-84e8-4dd5f51c1bd1.jpg" width="600">

### Styled

```php
use Solital\Core\Console\Table;

$table = new Table();
$table->setBorderStyle(Table::COLOR_BLUE);
$table->setCellStyle(Table::COLOR_GREEN);
$table->setHeaderStyle(Table::COLOR_RED, Table::BOLD);

$table->setColumnCellStyle('id', Table::ITALIC, Table::COLOR_LIGHT_YELLOW);
$table->setColumnCellStyle('email', Table::BOLD, Table::ITALIC);

$table->row([
    'id'        => 1,
    'name'      => 'Matthew S.',
    'surname'   => 'Kramer',
    'email'     => 'matthew@example.com',
    'status'    => true,
]);

$table->row([
    'id'        => 2,
    'name'      => 'Millie J.',
    'surname'   => 'Koenig',
    'email'     => 'millie@example.com',
    'status'    => false,
]);

$table->row([
    'id'        => 3,
    'name'      => 'Regina G.',
    'surname'   => 'Hart',
    'email'     => 'regina@example.com',
    'status'    => true,
]);

echo $table;
```

Output : 

<img src="https://user-images.githubusercontent.com/104234499/186993365-82c0e55d-d572-45d2-a89a-5cf60c5c9fbe.jpg" width="600">

Credits - [Muhammet ŞAFAK](https://github.com/muhammetsafak)

**Dynamic Rows**

If you need a standard header and just add the values, use the `dynamicRows` method.

```php
use Solital\Core\Console\Table;

$header = ['name', 'email', 'age'];

$values = [
  ['Foo', 'foo@email.com', 20],
  ['Bar', 'bar@email.com', 30]
];

$table = new Table();
$table->setHeaderStyle(Table::COLOR_LIGHT_GREEN);
$table->dynamicRows($header, $values);
```

**Formatted Row**

Formatted lines are a way of organizing data that contains some additional information. You can see an example of this method in use by running the `php vinci list` command.

```php
use Solital\Core\Console\Table;

$values = [
  'user' => 'Admin',
  'email' => 'admin@gmail.com'
];

Table::formattedRowData($values);
```

The second parameter you can define the spacing between the information. In the third parameter you can create a margin on the left side.

```php
use Solital\Core\Console\Table;

$values = [
  'user' => 'Admin',
  'email' => 'admin@gmail.com'
];

Table::formattedRowData($values, 50, true);
```