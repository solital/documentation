## Upgrading from version 3.x to 4.x

### composer.json

Update the Core package in your `composer.json` file:

```bash
"solital/core": "4.*"
```

### .env

These variables below will no longer be used in version `4.x`, so they should be removed.

```bash
INDEX_LOGIN="solital_index_login"
PRODUCTION_MODE="false"
```

### config.php

In the `config.php` file, add the constant `SITE_ROOT` at the beginning of the file, and replace the line below:

```php
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();
```

For this:

```php
use Solital\Core\Kernel\Dotenv;

Dotenv::env(__DIR__);
```

The `config.php` file should be as follows:

```php
<?php

define('SITE_ROOT', __DIR__);

require_once 'vendor/autoload.php';

use Solital\Core\Kernel\Application;
use Solital\Core\Kernel\Dotenv;

Application::sessionInit();
Dotenv::env(__DIR__);

if (!empty(getenv('ERRORS_DISPLAY'))) {
    if (getenv('ERRORS_DISPLAY') == 'true') {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
}
```

### User command

Find the `Config` class inside the `app/Console/` folder and change the `getCommandClass()` method:

```php
public function getCommandClass(): array
{
    $this->command_class = Application::getUserCommands();
    return $this->command_class;
}
```

### index.php

First, locate the file inside the `public/` folder.

The `index.php` file has few changes. The only things you need to do are: remove the constant `SITE_ROOT` as it will already exist in the `config.php` file, and replace the line below:

```php
Course::csrfVerifier(new BaseCsrfVerifier());
```

For this:

```php
Application::loadCsrfVerifier();
```

The `index.php` file should be as follows:

```php
<?php

require_once dirname(__DIR__). '/vendor/autoload.php';

use Solital\Core\Course\Course;
use Solital\Core\Kernel\Application;

Application::autoload("../vendor/solital/core/src/Resource/Helpers/");

Course::setDefaultNamespace('\Solital\Components\Controller');
Application::loadCsrfVerifier();

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

To verify that the update was successful, run `php vinci version` to see the Core version. Also, run `php vinci server` to check on the splash screen that everything is working.