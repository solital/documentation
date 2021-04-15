## Validation

You can validate email, string, array and others.

### Validate email, string and more

#### Email

```php
$res = Valid::email('solital@email.com');

/* Return `string` if true or `null` if false */
pre($res);
```

#### Number

You can validate whether a number is `int` or` float`. 

```php
$res = Valid::number(12.5);

/* Return `int` or `float` if true or `null` if false */
pre($res);
```

#### Null

```php
$res = Valid::isNull(null);

/* Return bool */
pre($res);
```

#### Lowercase

You can validate a string if it is lowercase. If not, the `isLower` method will 
convert the string to lowercase. 

```php
$res = Valid::isLower('SOLITAL');

/* Return string */
pre($res);
```

#### Uppercase

You can validate a string if it is uppercase. If not, the `isUpper` method will 
convert the string to uppercase. 

```php
$res = Valid::isUpper('solital');

/* Return string */
pre($res);
```