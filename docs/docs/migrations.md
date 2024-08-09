## Introduction

Basically, it consists of maintaining the versioning of an application's database and manipulating it through code, enabling the sharing of all its change history.

This makes life a lot easier for any development team, as it makes it possible to change the application schema just by executing the code responsible for it, which is also versioned and shared with the rest of the project.

## Creating migrations

All migrations are stored in `app/Database/Migrations`. To create a migration, you must use the Vinci Console.

<!-- ``bash
php vinci create:migration
``

If you want, you can give the migration a name. -->

```bash
php vinci create:migration user
```

You can create a migration with a ready-made structure to create a table in the database, for that use the word `create` in the argument.

```bash
php vinci create:migration create_user
```

## Structure of the migration

Below is the structure of a standard migration:

```php
<?php

namespace Solital\Database\Migrations;

use Solital\Core\Database\Migrations\Migration;

class Migration20211220193145 extends Migration
{
    /**
     * Run migration
     * 
     * @return mixed
     */
    public function up()
    {
        //
    }

    /**
     * Roolback migration
     * 
     * @return mixed
     */
    public function down()
    {
        //
    }
}
```

If you used the word `create` in the argument, the default structure changes a bit like this:

```php
<?php

namespace Solital\Database\Migrations;

use Katrina\Katrina;
use Solital\Core\Database\Migrations\Migration;

class Migration20211220193145 extends Migration
{
    /**
     * Run migration
     * 
     * @return mixed
     */
    public function up()
    {
        Katrina::createTable("user")
            ->int('id')->primary()
            // ...
            ->createdUpdatedAt()
            ->closeTable();
    }

    /**
     * Roolback migration
     * 
     * @return mixed
     */
    public function down()
    {
        Katrina::dropTable("user");
    }
}
```

## Running migrations

To run migrations, it's simple: run the command below:

```bash
php vinci migrate
```

If you have a new migration or one that hasn't been run, use the `--status` option.

```bash
php vinci migrate --status
```

## Rollback migrations

If you want to roll back a migration, use the `--rollback` option.

```bash
php vinci migrate --rollback
```

The previous command will roll back all migrations created using the `up()` method. To limit the number of migrations, assign a value to `--rollback`.

```bash
php vinci migrate --rollback=3
```