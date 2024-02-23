## Version

Katrina ORM is currently at version **2.x**. To read documentation for previous versions choose one of the links below.

[1.x](katrina1.md)

## Getting Started

Katrina ORM is a component that brings the object-oriented application development paradigm closer to the relational database paradigm. It helps to carry out common routines, such as the famous CRUD (create, read, edit and delete), in addition to having a data paging system.

Katrina ORM uses the Active Record standard to manipulate the data in the database.

### Requirements

- PHP >= 8.3
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
DB_DRIVE=your_drive
DB_HOST=your_host
DB_NAME=your_database_name
DB_USER=your_user
DB_PASS=your_password
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
DB_DRIVE=your_drive
DB_HOST=your_host
DB_NAME=your_database_name
DB_USER=your_user
DB_PASS=your_password
SQLITE_DIR=/path/to/file/
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

## SELECT

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
User::select()->where('id', 2)->getUnique();

/** 
 * Fetch all with column name
 */
User::select("name")->get();
```

You can return the latest values from the database in descending order using the `latest` method:

```php
User::latest()->get();
```

By default, the `latest` method will sort using the `created_at` column. If this column does not exist in your table, you can pass the name of another column as a parameter.

```php
User::latest('users')->get();
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

**AND/OR**

If there are more conditions for the `where` method, you can make use of the `and/or` methods:

```php
/** 
 * With AND clause
*/
User::select()->where("brand", 'visa')->and("cvv", '502')->get();

/**
 * With OR clause
 */
User::select()->where("brand", 'visa')->or("cvv", '502')->get();
```

**Multiple WHERE**

To save time and avoid using the `and` method, you can pass an array as a parameter in the `where` method with multiple conditions.

```php
User::select()->where([
  'brand', 'visa',
  'cvv', '502'
])->get();
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

**COUNT**

The `count` method returns the total number of values in a table.

```php
User::count();
```

If you want to specify the name of a column, use the first parameter. And to use the WHERE clause, use the second parameter.

```php
// `Email` column
User::count("email");

// `Email` column with WHERE clause
User::count("email", "email='solital@gmail.com'");
```

### Using INNER JOIN

The `innerJoin()` method returns the values of two tables that have a foreign key.

The first parameter represents the table containing the foreign key. The second parameter represents the `id` of the foreign key.

```php
User::select()
    ->innerJoin("table1", "id1")
    ->innerJoin("table2", "id2")
    ->get();
```

If you need to use the `WHERE` clause, use the `where()` method.

```php
User::select()
    ->innerJoin("table1", "id1")
    ->innerJoin("table2", "id2")
    ->where("phone", 123123123)
    ->get();
```

NOTE: If you have two or more tables where the column names are the same, remember to specify the table names in the `where()` method:

```php
User::select()
    ->innerJoin("table1", "id1")
    ->innerJoin("table2", "id2")
    ->where("table1.phone", 123123123)
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
$sql = User::select(null, "nome")->where("nome", "brenno")->rawQuery();
$result =  User::select(null, "nome, idade")->where("nome", Functions::subquery($sql))->get();

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

<table class="table">
  <thead>
    <tr>
      <th scope="col">Aggregate Functions</th>
      <th scope="col">Date Functions</th>
      <th scope="col">Math Functions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="cmd-vinci">avg($value)</span></td>
      <td><span class="cmd-vinci">now()</span></td>
      <td><span class="cmd-vinci">abs($value)</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">count($expression = "*", $as = "")</span></td>
      <td><span class="cmd-vinci">curdate()</span></td>
      <td><span class="cmd-vinci">sum($value)</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">max($value)</span></td>
      <td><span class="cmd-vinci">date($value)</span></td>
      <td><span class="cmd-vinci">truncate($number, $decimal_places)</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">-</span></td>
      <td><span class="cmd-vinci">hour($value)</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">-</span></td>
      <td><span class="cmd-vinci">month($value)</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">-</span></td>
      <td><span class="cmd-vinci">datediff($first_date, $second_date)</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">-</span></td>
      <td><span class="cmd-vinci">day($date = null)</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">-</span></td>
      <td><span class="cmd-vinci">currentTimestamp()</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
  </tbody>
</table>

### INSERT
 
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

### UPDATE

**With ActiveRecord**

The process for updating a record in the table is very similar to inserting a record. However, you need to specify the `id` of your table:

```php
$user = new User();
$user->id = 1;
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
    'email' => 'harvey@specterlitt.com'
])->where('id', 1)->saveUpdate();
```

### Delete

To delete a record from the table, use the `delete()` method.

```php
User::delete('id', 2);
```

If you want to delete a row that has a foreign key in another table, the `$safe_mode` parameter must be changed to `false`:

```php
User::delete('id', 2, false);
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
    ->createdUpdatedAt()
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

### Timestamps

If you want to change the name of the `created_at` and `updated_at` columns, use the properties below:

```php
<?php

namespace Solital\Components\Model;
use Katrina\Katrina;

class User extends Katrina
{
    protected string $created_at = 'created_date';
    protected string $updated_at = 'updated_date';
}
```

You can also rename columns when creating a table in the database using the `createdUpdatedAt` method.

```php
// ...

->createdUpdatedAt('created_date', 'updated_date')

// ...
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

## Transactions

Transactions are typically implemented by "saving-up" your batch of changes to be applied all at once; this has the nice side effect of drastically improving the efficiency of those updates. In other words, transactions can make your scripts faster and potentially more robust (you still need to use them correctly to reap that benefit).

```php
try {
  $pdo = Connection::getInstance();
  $pdo->beginTransaction();

  // code...

  $pdo->commit();

} catch (\PDOException $e) {
  $pdo->rollback();
  
  echo $e->getMessage();
}
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

**Transactions**

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

<table style="margin-bottom: 20px;">
  <thead>
    <tr>
      <th>Name</th>
      <th>Age</th>
      <th>Gender</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Sam</td>
      <td>47</td>
      <td>Male</td>
    </tr>
    <tr>
      <td>Dean</td>
      <td>49</td>
      <td>Male</td>
    </tr>
    <tr>
      <td>Marry</td>
      <td>52</td>
      <td>Female</td>
    </tr>
  </tbody>
</table>

<span class="katrina-pag"><< 1</span> 2 <span class="katrina-pag">3 >></span>


To change the arrows (`<<` and `>>`), use the parameters of the `getArrows()` method. The result will be:

```html
{{ $values->getArrows('First', 'Last'); }}
```

<table style="margin-bottom: 20px;">
  <thead>
    <tr>
      <th>Name</th>
      <th>Age</th>
      <th>Gender</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Sam</td>
      <td>47</td>
      <td>Male</td>
    </tr>
    <tr>
      <td>Dean</td>
      <td>49</td>
      <td>Male</td>
    </tr>
    <tr>
      <td>Marry</td>
      <td>52</td>
      <td>Female</td>
    </tr>
  </tbody>
</table>

<span class="katrina-pag">First</span> 2 <span class="katrina-pag">3 Last</span>

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

## Cache

To enable Katrina ORM caching in Solital, you must change the `cache_database` variable to `true` in the `cache.yaml` file.

```yaml
# Enable cache on Katrina ORM
cache_database: true
```

To configure caching in Solital, see the documentation [here](https://solital.github.io/site/docs/4.x/cache/#cache-drive).

If you are NOT using Katrina ORM together with Solital, you must configure the constants manually:

```php
define('DB_CACHE', [
    'CACHE_TYPE' => 'memcached',
    'CACHE_HOST' => '127.0.0.1',
    'CACHE_PORT' => 11211,
    'CACHE_TTL' => 600
]);
```

Katrina ORM supports the following drivers

- Memcached
- Memcache
- APCu

In your Model, you will need to enable caching. To do this, add the following property:

```php
<?php

namespace Solital\Components\Model;
use Katrina\Katrina;

class User extends Katrina
{
    /**
     * @var bool|null
     */
    protected ?bool $cache = true;
}
```

## Multiple connections

In specific cases it is necessary to use two different databases. Katrina ORM supports you to use a second database.

To do this, you must add the following variables to your `.env` file:

```bash
DB_HOST_SECONDARY=localhost
DB_NAME_SECONDARY=second_database
DB_USER_SECONDARY=root
DB_PASS_SECONDARY=""
SQLITE_DIR_SECONDARY=""
```

If you are NOT using Solital, you must create the following constants:

```php
define('DB_CONFIG_SECONDARY', [
    'HOST' => 'localhost',
    'DBNAME' => 'second_database',
    'USER' => 'root',
    'PASS' => '',
    'SQLITE_DIR' => ''
]);
```

So, to use the second connection to the other database, use the `connection` method:

```php
# Main database
User::select()->get();

# Second database
User::connection('pgsql')::select()->get();
```

## Types of data

Below is listed the attributes and data supported by Katrina ORM:

<table class="table">
  <thead>
    <tr>
      <th scope="col">String data</th>
      <th scope="col">Numerical data</th>
      <th scope="col">Date and time</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="cmd-vinci">varchar("column_name", size)</span></td>
      <td><span class="cmd-vinci">tinyint("column_name", size)</span></td>
      <td><span class="cmd-vinci">date("column_name")</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">char("column_name", size)</span></td>
      <td><span class="cmd-vinci">smallint("column_name", size)</span></td>
      <td><span class="cmd-vinci">year("column_name")</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">tinytext("column_name", size)</span></td>
      <td><span class="cmd-vinci">mediumint("column_name", size)</span></td>
      <td><span class="cmd-vinci">time("column_name")</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">mediumtext("column_name", size)</span></td>
      <td><span class="cmd-vinci">bigint("column_name", size)</span></td>
      <td><span class="cmd-vinci">datetime("column_name")</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">longtext("column_name", size)</span></td>
      <td><span class="cmd-vinci">int("column_name", size)</span></td>
      <td><span class="cmd-vinci">timestamp("column_name")</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">text("column_name")</span></td>
      <td><span class="cmd-vinci">decimal("column_name", value1, value2)</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
  </tbody>
</table>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Attributes</th>
      <th scope="col">Boolean</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="cmd-vinci">boolean("column_name")</span></td>
      <td><span class="cmd-vinci">default("default_value")</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">unique()</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">unsigned()</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">incremet() (MYSQL)</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">notNull()</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">primary()</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">after("column_name")</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">first()</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">serial("id_table") (POSTGRESQL)</span></td>
      <td><span class="cmd-vinci">-</span></td>
    </tr>
  </tbody>
</table>