## Introduction

A seeder is a special class used to generate and insert sample data (seeds) into a database. This is an important feature in development environments, as it allows you to recreate the application with a fresh database, using sample values that you would otherwise have to manually enter each time the database was recreated.

## Creating Seeders

To create a seeder, you will need to use the Vinci Console:

```bash
php vinci create:seeder UserSeeder
```

The command will generate a class similar to this:

```php
<?php

use Solital\Core\Database\Seeds\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run a Seed
     */
    public function run()
    {
        // ...
    }
}
```

All code you create must be inside the `run()` method.

### Calling other Seeders

You can call other seeders within a seeder. For that use the `call()` method.

```php
<?php

use Solital\Core\Database\Seeds\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run a Seed
     */
    public function run()
    {
        $this->call(UserSecondSeed::class);
        $this->call(UserThirdSeed::class);
    }
}
```

Or use an array:

```php
public function run()
{
    $this->call([
        UserSecondSeed::class,
        UserThirdSeed::class
    ]);
}
```

## Running Seeders

To run the created Seeders, run the command:

```bash
php vinci seeder
```

The previous command runs all seeders. To run a specific seeder, use the `--class` option.

```bash
php vinci seeder --class=UserSeeder
```