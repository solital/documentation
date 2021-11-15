You can create and remove tables, add a foreign key, add a column to the table, among other SQL commands using the `SQL` class and the Vinci Console. This class is found in the `app/Database`. 

```php
<?php

namespace Solital\Database;

use Solital\Core\Database\Create\Create;

class SQL extends Create
{
    /**
     * @return void
     */
    public function tableExample(): void
    {
        $this->orm->createTable('table_test')
                        ->int('id_table')->notNull()
                        ->varchar('name', 100)->notNull()
                        ->closeTable()
                        ->build();
    }
}
```

And in vinci, execute the method as follows:

```bash
php vinci katrina:tableExample
```

## Cache of SQL commands

For each run that is made, a cached file will be generated. This file is important if you want to keep a history of the commands that were executed.

To find the directory of these cached files, go to the `sql` folder inside `app/Storage/cache`. 

**NOTE:** Whenever you clear the cache with the `php vinci cache-clear` command, the cached SQL files are also deleted.

## Default username and password

You can create a standard database login table using the command `php vinci katrina-auth`. This command will insert a default email and password. To authenticate, use the email `solital@email.com` and password `solital`

**NOTE:** When creating the login structure with the command `php vinci katrina-auth`, the method `userAuth` is executed automatically, it is not necessary to execute it later.

## Dump Database

It is possible to create a backup of your entire database. First, make sure your `.env` file has the correct connection.

** On Windows **

By default, on Windows you need to run an `exe` file from your database. For this, you can add in the variables the path where this `exe` file is located: `MYSQL_DUMP` (For MySQL database) and `PG_DUMP` (For PostgreSQL database).

```bash
# This is an example of a project using XAMPP. 
# The file "mysqldump.exe" is located in this directory.

MYSQL_DUMP="C:\\xampp\\mysql\\bin\\mysqldump.exe"
```

Then, just run the `php vinci katrina-dump` command to dump the database. The created file will be saved to `app/Storage/dump`. 