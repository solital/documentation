## Version

Katrina ORM is currently at version **2.x**. To read documentation for previous versions choose one of the links below.

[1.x](http://solitalframework/katrina/1.x/)

## Getting Started

Katrina ORM is a component that brings the object-oriented application development paradigm closer to the relational database paradigm. It helps to carry out common routines, such as the famous CRUD (create, read, edit and delete), in addition to having a data paging system.

Katrina ORM uses the Active Record standard to manipulate the data in the database.

### Requirements

- PHP >= 8.0
- PDO extension enabled

### Installation

Katrina ORM is already installed by default in Solital. But if you are going to install in another project, use the command below to download via Composer.

```
composer require solital/katrina
```

### Settings

In Solital:

```bash
# DATABASE CONFIG
DB_DRIVE="your_drive"
DB_HOST="your_host"
DB_NAME="your_database_name"
DB_USER="your_user"
DB_PASS="your_password"
```

In another project:

```php
define('DB_CONFIG', [
    'DRIVE' => 'your_drive',
    'HOST' => 'your_host',
    'DBNAME' => 'your_database_name',
    'USER' => 'your_user',
    'PASS' => 'your_password'
]);
```

### For SQLite

Some differences exist for connecting to an SQLite database. First, add an additional index called `SQLITE_DIR` in the `DB_CONFIG` constant. This constant must have the absolute path where the SQLite database file will be located.

Then, assign the value `sqlite` in the index `DRIVE`.

```php
define('DB_CONFIG', [
    'DRIVE' => 'sqlite',
    'DBNAME' => 'your_database_name.db',
    'SQLITE_DIR' => '/path/to/file/'
]);
```

In Solital:

```bash
# DATABASE CONFIG
DB_DRIVE="your_drive"
DB_HOST="your_host"
DB_NAME="your_database_name"
DB_USER="your_user"
DB_PASS="your_password"
SQLITE_DIR="/path/to/file/"
```

## Initial structure

To initialize the Katrina ORM in your Model, just extend the `Katrina` class.

```php
<?php

namespace Solital\Components\Model;
use Katrina\Katrina;

class User extends Katrina
{
    
}
```

## Changing default fields

By default, your class table name is the class name itself, and the primary key name is `id`.

You can change these settings using the `$table` and `$id` variables.

```php
<?php

namespace Solital\Components\Model;
use Katrina\Katrina;

class User extends Katrina
{
    /**
     *  @var null|string 
     */
    protected ?string $table = "tb_user";

    /**
     *  @var null|string 
     */
    protected ?string $id = "id_user";

    /**
     *  @var null|bool
     */
    protected bool $timestamp = false; 
}
```

## List

To list all fields in the table, use `all()` as shown in the previous example.

```php
User::all();
```

To list a single value, use `find()` method;

```php
User::find(2);
```

Or, use the `select` method:

```php
/** 
 * Fetch all
 */
User::select()->get();

/** 
 * Fetch only
 */
User::select(2)->get();

/** 
 * Fetch all with column name
 */
User::select(null, "name")->get();
```

**WHERE**

If you need the `WHERE` clause, use `where()` method.

```php
/** 
 * Katrina will look for a record that has `foo` in the table.
*/
User::select()->where("name", "foo")->get();

/** 
 * Katrina will look for a record whose age is greater than 10.
*/
User::select()->where("age", 10, ">")->get();

/** 
 * Katrina will look for a record that is under the age of 10.
*/
User::select()->where("age", 10, "<")->get();
```

**LIKE and BETWEEN**

You can combine the `where` method with other search methods such as `like` and `between`.

```php
/** 
 * With LIKE clause
*/
User::select()->where("name")->like("%foo%")->get();

/** 
 * With BETWEEN clause
*/
User::select()->where("age")->between(10, 22)->get();
```

**LIMIT**

```php
User::select()->limit(0, 3)->get();
```

**ORDER BY**

```php
User::select()->order("name")->get();
```

By default, the result will always return ascending. To return values descending, use `false` in the second parameter.

```php
User::select()->order("name", false)->get();
```

**GROUP BY**

The `group by` SQL command requires the use of a function. Use the `group()` method together with the `Functions` class (see [here](#functions)).

```php
User::select(null, "name, " . Functions::count('*', 'qtd'))->group("name")->get();
```

### Using INNER JOIN

The `innerJoin()` method returns the values of two tables that have a foreign key.

The first parameter represents the table containing the foreign key. The second parameter represents the `id` of the foreign key.

```php
User::select()
    ->innerJoin("sobrenome", "id_nome")
    ->innerJoin("cpf", "idUsu")
    ->get();
```

If you need to use the `WHERE` clause, use the `where()` method.

```php
User::select()
    ->innerJoin("sobrenome", "id_nome")
    ->innerJoin("cpf", "idUsu")
    ->where("cpf_number", 123123123)
    ->get();
```

### Custom SELECT

You can create a custom SELECT statement. To do this, use the function `customQuery`.

```php
/** 
 * Fetch Only
 */
User::customQuery("SELECT * FROM users");

/** 
 * Fetch All
 */
User::customQuery("SELECT * FROM users", true);
```

### SELECT inside SELECT

Some SQL queries need to have multiple SELECTs, and sometimes those SELECTs are inside other SELECTs. If you need such a query, follow the example:

```php
$sql = ORMTest::select(null, "nome")->where("nome", "brenno")->rawQuery();
$result =  ORMTest::select(null, "nome, idade")->where("nome", Functions::subquery($sql))->get();

var_dump($result);
```

The `rawQuery()` function will return an SQL string (you can use a `var_dump()` to parse the returned string). Then, to use that SQL string inside another query, use the `subquery()` function.

## Functions

Katrina 2 supports SQL functions. You can use a function in an SQL query using the `Function` Method:

```php
use Katrina\Functions\Functions;

User::select(null, "name, " . Functions::count('*', 'qtd'))->group("name")->get();
```

Below is a list of all the functions present in Katrina ORM:

**Aggregate Functions**

|                              |
|-------------------------------------|
| `avg($value)`                       |
| `count($expression = "*", $as = "")`|
| `max($value)`                       |
| `min($value)`                       |

**Date Functions**

|                              |
|---------------------------------------|
| `now()`                               |
| `curdate()`                           |
| `date($value)`                        |
| `hour($value)`                        |
| `month($value)`                       |
| `datediff($first_date, $second_date)` |
| `day($date = null)`                   |
| `currentTimestamp()`                  |

**Math Functions**

|                              |
|--------------------------------------|
| `abs($value)`                        |
| `sum($value)`                        |
| `truncate($number, $decimal_places)` |

### Insert
 
Katrina uses the ActiveRecord standard to insert and update database data. However, if you don't want to use the ActiveRecord pattern, you can use the `insert()` and `update()` methods.

**With ActiveRecord**

To insert data in the table, you must use the column name as a value. If your table has `name`, `age` and `email` columns, then the values should be used following that same sequence.

Note the code below:

```php
$user = new User();
$user->name = "Harvey Specter";
$user->age = 40;
$user->email = "harvey@pearsonspecterlitt.com";
$user->save();
```

**With the `insert` method**

To save data, you must pass an array in which the keys will be the columns of the table. The values of these keys will be inserted into the database.

```php
User::insert([
    'name' => 'Harvey Specter',
    'age' => 40,
    'email' => 'harvey@pearsonspecterlitt.com'
]);
```

If you want to retrieve the last ID entered, use the `lastId()` method.

```php
$res = User::insert([
    'name' => 'Harvey Specter',
    'age' => 40,
    'email' => 'harvey@pearsonspecterlitt.com'
])->lastId();

var_dump($res);
```

### Update

**With ActiveRecord**

The process for updating a record in the table is very similar to inserting a record. For that you must use the `find()` method. The `find()` method is to indicate which record you want to update.

```php
$user = User::find(2);
$user->name = "Harvey Specter";
$user->age = 42;
$user->email = "harvey@specterlitt.com";
$user->save();
```

**With the `update` method**

The process for updating a value in the database using the `update` method is similar to using the `insert` method. The difference is that you will use the `where` method to define the values that will be updated. And to save those changes, the `saveUpdate` method must be present.

```php
User::update([
    'name' => 'Harvey Specter',
    'age' => 42,
    'email' => 'harvey@pearsonspecterlitt.com'
])->where('id', 1)->saveUpdate();
```

### Delete

To delete a record from the table, use the `delete()` method together with the `find()` method.

```php
$user = User::find(2);
$user->delete();
```

You can also list all records using the `all()` method:

```php
foreach(User::all() as $user)
{
    $user->delete();	
}
```

## Manipulating tables

### Create a new table

The `createTable()` method starts opening the table. After inserting the fields and data types that the tables will have, use `closeTable()` to close the table. For a better understanding see the syntax below.

```php
User::createTable("your_table_name")
    /* Fields and table type */
    ->int("id_user")->primary()->increment()
    ->varchar("name", 20)->unique()->notNull()->default("specter")
    ->int("age", 3)->unsigned()->notNull()
    ->varchar("email", 30)->default("harvey.specter@gmail.com")->notNull()
    ->varchar("profession", 40)
    ->constraint("dev_cons_fk")->foreign("type")->references("dev", "iddev")
    /* Close the command to create the table */
    ->closeTable();
```

**For POSTGRESQL**

Postgresql doesn't natively support the `AUTO_INCREMENT` command. An alternative is to use the `SERIAL` command. So, if you are going to create a table using Postgresql as a database, use the `serial()` method.

```php
User::createTable("your_table_name")
    ->serial('id_user')->primary()
    # ...
```

### List tables

To have a list of all the tables in your database, use the `listTables()` method.

```php
User::listTables();
```

### List columns

To list the columns of a table, use the `describeTable()` method passing as a parameter the name of your table.

```php
User::describeTable('your_table');
```

### Alter table

The `alter()` method performs the procedures of adding, changing and deleting a field from the database table.

**Add new field**

Use `add()` method together with the data type to add a new field.

```php
(new User)->alter("your_table")->varchar("username", 20)->add();
```

**Drop column**

Use the `drop()` method to delete a column from the table.

```php
(new User)->alter("your_table")->drop("username");
```

**Modify column**

Use the modify SQL with the `modify()` method.

```php
(new User)->alter("your_table")->varchar("name", 100)->modify();
```

**Rename table**

Use the `rename()` method to rename a database table.

```php
(new User)->alter("your_table_name")->rename("new_table_name");
```

### Adding foreign key

To add a foreign key to an already created table, use the `constraint()` method to add a constraint; `foreign()` to inform the column and `references()` to refer to the table.

```php
(new User)->alter("your_table")->constraint("dev_cons_fk")->foreign("type")->references("dev", "iddev");
```

### Truncate table

To use the sql truncate command, use the `truncate()` method.

```php
(new User)->truncate("your_table");
```

By default, the database checks the table's foreign key and locks the truncate command. To disable foreign key verification, enter `true` as a parameter.

```php
(new User)->truncate("your_table", true);
```

## Procedure

To call a database procedure, use the `call()` method.

```php
(new User)->call('procedure_name');
```

To use procedure parameters, pass the values in array format.

```php
(new User)->call('procedure_name' , ['param_1, param_2, param_3']);
```

## Pagination

The `pagination()` method creates a system for paging results. To initialize, the first parameter must be the table you want to use to start paging. The second parameter will list the amount of values that will be returned from the table as shown in the example below.

```php
$values = (new User)->pagination('your_table', 3);
```

To retrieve the table values from the database, you can use the `getRows()` method. And to use pagination, use the `getArrows()` method.

```php
/** Returns table data */
$values->getRows();

/** Returns commands to advance or return */
$values->getArrows()
```

To use pagination with relationship in another table, in the third parameter pass an array containing the name of the table that has a relationship with the current table, the column name of the current table that has the foreign key and the column name of the primary key of the another table.

```php
$values = (new User)->pagination('your_table', 3, ['foreign_table', 'column_foreign_key', 'column_primary_key']);
```

**INNER JOIN**

If you want to use pagination with a table that has a foreign key, pass an array in the third parameter.

In the first index, insert the name of the table that is linked to the current table, in the second index the name of the column that contains the foreign key and in the third index the column name of the primary key of the table that references the current table

```php
$values = (new User)->pagination('your_table', 3, ['foreign_table', 'column_foreign_key', 'column_primary_key'], "status=true");
```

**WHERE clause**

To use the WHERE clause, use the fourth parameter as shown below.

```php
$values = (new User)->pagination('your_table', 3, null, "status=true");
```

**Wolf Template**

Data pagination is widely used in project templates. You can integrate pagination into Wolf Template as follows:

```php
$values = (new User)->pagination('your_table', 3);

return view('home', [
    'values' => $values
]);
```

In your template, retrieve the data like this:

```html
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
        </tr>
    </thead>

    <tbody>
        {% foreach ($values->getRows() as $result): %}
            <tr>
                <td>{{ $result['name'] }}</td>
                <td>{{ $result['age'] }}</td>
                <td>{{ $result['gender'] }}</td>
            </tr>
        {% endforeach; %}
    </tbody>
</table>

{{ $values->getArrows(); }}
```

The result will be as follows:

```html
| Name  | Age | Gender |
|-------|-----|--------|
| Sam   | 47  | Male   |
| Dean  | 49  | Male   |
| Marry | 52  | Female |

<< 1 2 3 >>
```

To change the arrows (`<<` and `>>`), use the parameters of the `getArrows()` method. The result will be:

```html
{{ $values->getArrows('First', 'Last'); }}
```

```html
| Name  | Age | Gender |
|-------|-----|--------|
| Sam   | 47  | Male   |
| Dean  | 49  | Male   |
| Marry | 52  | Female |

First 1 2 3 Last
```

## Custom Pagination

The `pagination()` method uses a basic SELECT statement. If you need to use a much more complex SELECT, consider using the `customPagination()` method.

```php
$values = (new User)->customPagination("SELECT created_at, order_status, idSession, SUM(idOrder) AS idOrder FROM `tb_order` 
GROUP BY created_at, order_status, idSession", 3);
```

**Customizing arrows CSS**

You can customize the look of the arrows through the classes `pagination_first_item`, `pagination_atual_item`, `pagination_others_itens` and `pagination_last_item`.

Below is a customization to serve as an example:

```html
.pagination_atual_item {
    background-color: #B5B5B5;
    padding: 10px;
    margin: 5px;
    border-radius: 5px;
    margin-top: 30px;
    transition: 0.2s;
}

.pagination_first_item, .pagination_others_itens, .pagination_last_item {
    background-color: #4682B4;
    color: #FFF;
    padding: 10px;
    margin: 5px;
    border-radius: 5px;
    margin-top: 30px;
    transition: 0.2s;
    text-decoration: none;
}

.pagination_first_item:hover, .pagination_others_itens:hover, .pagination_last_item:hover {
    background-color: #0071E3;
    color: #FFF !important;
    transition: 0.2s;
}
```

## Types of data

Below is listed the attributes and data supported by Katrina ORM:

**String data**

|                              |
|-----------------------------------|
| `varchar("column_name", size)`    |
| `char("column_name", size)`       |
| `tinytext("column_name", size)`   |
| `mediumtext("column_name", size)` |
| `longtext("column_name", size)`   |
| `text("column_name")`             |

**Numerical data**

|                                     |
|------------------------------------------|
| `tinyint("column_name", size)`           |
| `smallint("column_name", size)`          |
| `mediumint("column_name", size)`         |
| `bigint("column_name", size)`            |
| `int("column_name", size)`               |
| `decimal("column_name", value1, value2)` |

**Date and time**

|                        |
|-----------------------------|
| `date("column_name")`       |
| `year("column_name")`       |
| `time("column_name")`       |
| `datetime("column_name")`   |
| `timestamp("column_name")`  |

**Boolean**

|                        |
|-----------------------------|
| `boolean("column_name")`    |

**Attributes**

|                       |
|----------------------------|
| `default("default_value")` |
| `unique()`                 |
| `unsigned()`               |
| `incremet()` (MYSQL)       |
| `notNull()`                |
| `primary()`                |
| `after("column_name")`     |
| `first()`                  |
| `serial("id_table")` (POSTGRESQL)       |