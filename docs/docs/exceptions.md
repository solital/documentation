## Introduction

Solital uses the [Modern PHP Exception](https://github.com/brenno-duarte/modern-php-exception) component to handle all exceptions and display them to the user in an intuitive and modern way.

You can check the complete documentation for this component to better understand its use, but here you will see how this component works in Solital.

## Customizing exceptions

To customize exceptions, and also enable night mode, you can change the settings in the `exceptions.yaml` file.

**Changing the page title**

```yaml
title: My title
```

**Enabling dark mode**

```yaml
# Default: false
dark_mode: true
```

**Enabling production mode**

```yaml
# Default: false
production_mode: true
```

To change the message, change the `error_message` variable:

```yaml
production_mode: true
error_message: Something wrong!
```

**Load CSS files if there is no internet connection**

```yaml
# Use `false` only if you have no internet connection
enable_cdn_assets: false
```

**Enable occurrences**

If you want to have a history of all exceptions and errors that your application displays, you can enable the occurrences using the `enable_occurrences` option on `exceptions.yaml`.

```yaml
enable_occurrences: true
```

Don't forget to configure the database.

```yaml
# Database for Modern PHP Exceptions
db_drive: mysql
db_host: localhost
db_name: database_name
db_user: root
db_pass: pass
```

## Creating a solution for an exception

If you are creating a custom exception class, you can add a solution to resolve this exception.

For that, use the static `getSolution` method implementing the `SolutionInterface` interface:

```php
<?php

namespace Test;

use ModernPHPException\Solution;
use ModernPHPException\Interface\SolutionInterface;

class CustomException extends \Exception implements SolutionInterface
{
    public function getSolution(): Solution
    {
        return Solution::createSolution('My Solution')
            ->setDescription('description')
            ->setDocs('https://google.com');
    }

    #...
```

- ``createSolution:`` Name of solution to fix exception
- ``setDescription:`` Detailed description of exception solution
- ``setDocs:`` If a documentation exists, this method will display a button for a documentation. By default, the name of the button will be `Read More`, but you can change the name by changing the second parameter of the method