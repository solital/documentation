## Upgrading from version 2.x to 3.x

### composer.json

Update the Core package in your `composer.json` file:

```bash
"solital/core": "3.*"
```

You should also remove the `slowprog/composer-copy-file` package. To do this, manually delete it in `composer.json` or run the command:

```bash
composer remove slowprog/composer-copy-file
```

After that, you need to remove any references to the previous package.

Replace this:

```json
"scripts": {
    "post-create-project-cmd": [
      "SlowProg\\CopyFile\\ScriptHandler::copy",
      "composer dump-autoload -o"
    ],
    "post-install-cmd": [
      "SlowProg\\CopyFile\\ScriptHandler::copy",
      "composer dump-autoload -o"
    ],
    "post-update-cmd": [
      "SlowProg\\CopyFile\\ScriptHandler::copy",
      "composer dump-autoload -o"
    ]
}
```

By this code:

```json
"scripts": {
    "post-create-project-cmd": [
        "composer dump-autoload -o"
    ],
    "post-install-cmd": [
        "composer dump-autoload -o"
    ],
    "post-update-cmd": [
        "composer dump-autoload -o"
    ]
}
```

Finally, remove the `extra` from your `composer.json` file:

```json
"extra": {
    "copy-file": {
      "vendor/solital/core/src/Resource/Helpers/": "app/Helpers/System",
      "vendor/solital/core/src/Console/Components/Templates/Controller.php": "app/Components/Controller/",
      "vendor/solital/core/vinci": "vinci"
    }
}
```

### config.php

In the `config.php` file that is at the root of Solital, you will replace the existing code with this one:

```php
<?php

require_once __DIR__ .'/vendor/autoload.php';

use Solital\Core\Kernel\Application;

Application::sessionInit();

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

if (!empty(getenv('ERRORS_DISPLAY'))) {
    if (getenv('ERRORS_DISPLAY') == 'true') {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
}
```

### index.php

The `index.php` file has been completely changed. First, locate the file inside the `public/` folder. Then erase all the code present in that file and replace it with this one:

```php
<?php

/**
 * WARNING: DO NOT MAKE ANY KIND OF CHANGE IN THIS FILE. 
 * ANY KIND OF MODIFICATION WILL BREAK YOUR PROJECT. 
 */

require_once dirname(__DIR__). '/vendor/autoload.php';

use Solital\Core\Course\Course;
use Solital\Core\Kernel\Application;

define('SITE_ROOT', dirname(__DIR__));

Application::autoload("../vendor/solital/core/src/Resource/Helpers/");

Course::setDefaultNamespace('\Solital\Components\Controller');
Course::csrfVerifier(new \Solital\Core\Http\Middleware\BaseCsrfVerifier());

Application::autoload("../routers/");
Application::init();
```

## Classes and folders

Some classes and folders will no longer be used by version `3.x`. The following classes should be deleted: **SQL.php** (`app/Database/`) and **CustomConsole.php** (`app/`).

The following folders must be deleted along with all content: **Helpers** (`app/Helpers`).

## Vinci File

The Vinci Console has had a big change compared to the `2.x` version. For that, you'll have to replace all the code in the `vinci` file with this one:

```php
#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

define('SITE_ROOT', __DIR__);

$class_commands = [
    \Solital\Core\Kernel\Console\SolitalCommands::class,
    \Solital\Console\Config::class
];

(new \Solital\Core\Console\Command($class_commands))->read($argv[1], $argv);
```

If necessary, manually create the `Config.php` file inside the `app/Console/` folder.

```php
<?php

namespace Solital\Console;

use Solital\Core\Console\Interface\ExtendCommandsInterface;

class Config implements ExtendCommandsInterface
{
    /**
     * @var array
     */
    protected array $command_class = [];

    /**
     * @return array
     */
    public function getCommandClass(): array
    {
        return $this->command_class;
    }
}
```

### Copying new files

After all these changes, you will need to run the following command:

```bash
php vinci generate:files
```

This command will copy configuration files into the `app/config` folder. This command should be executed whenever there is an important update.

### Checking Solital Version

To verify that the update was successful, run `php vinci version` to see the Core version. Also, run `php -S localhost:8000 -t public/` to check on the splash screen that everything is working.