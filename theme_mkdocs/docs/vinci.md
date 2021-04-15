Vinci Console is an auxiliary component to help create files faster, such as login structures, password recovery structures, database configuration and more.

## Access Vinci

To access Vinci, open the terminal in your project folder and type `php vinci [command]`. To access information about Solital and its dependencies, open your terminal inside your project folder and type `php vinci version`

### For Windows

To run the Vinci console on Windows, remember to add the PHP directory to the Windows PATH.

## Create a component
You can create a new component using the syntax below.

```bash
php vinci [command]:[name_file]
```

**Example**

```bash
php vinci controller:UserController
```

| Command      | Description                             |
|--------------|-----------------------------------------|
| `controller` | Creates a new controller                |
| `model`      | Create a new Model                      |
| `view`       | Create a new view                       |
| `css`        | Create a new CSS file                   |
| `js`         | Create a new JavaScript file            |
| `routes`     | Creates a new file for the route system |

## Remove a component

Add the `remove-` command before using one of the aforementioned commands to remove a component created with Vinci.

```bash
php vinci remove-controller:UserController
```

## System Commands

To execute a command, use the following syntax:

```bash
php vinci [command]
```

| Command         | Description                                        |
|-----------------|----------------------------------------------------|
| `cache-clear`   | Clears the solital cache                           |
| `session-clear` | Clears the solital sessions                        |
| `login`         | Create classes for login                           |
| `remove-login`  | Removes the components created for login           |
| `forgot`        | Create classes for forgot password                 |
| `remove-forgot` | Removes the components created for forgot password |

-

You can view the complete list of Vinci commands using `php vinci show`. 

## Custom Command

To create a custom command, you can make use of the `Custom Console` class. This class is found inside the `app/` folder

For this, in the `execute` method, you must return the command to be typed in the array index, and in the index value the method that will be executed. 

```php
/**
 * @return array
 */
public function execute(): array
{
    return [
        'cmd-example' => 'tableExample'
    ];
}

/**
 * @return CustomConsole
 */
public function tableExample(): CustomConsole
{
    echo "This command is just a custom command test on the Vinci Console!\n";

    return $this;
}
```

You can test the predefined command in this class using `php vinci cmd-example`. 