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

In the `config.php` file that is at the root of Solital, you will remove just one line:

```php
require_once 'app/Helpers/helpers-custom.php';
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

### Copying new files

After all these changes, you will need to run the following command:

```bash
php vinci generate:files
```

This command will copy configuration files into the `app/config` folder. This command should be executed whenever there is an important update.

### Checking Solital Version

To verify that the update was successful, run `php vinci version` to see the Core version. Also, run `php -S localhost:8000 -t public/` to check on the splash screen that everything is working.