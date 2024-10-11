<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">
    This class was removed in Core 4.4. Please use the <a href="https://solital.github.io/site/docs/4.x/validation/">Validation</a> class
    </h6>
</div>

You can validate email, string, array and others.

### Email

```php
$res = Valid::email('solital@email.com');

/* Return `string` if true or `null` if false */
pre($res);
```

### Number

You can validate whether a number is `int` or` float`. 

```php
$res = Valid::number(12.5);

/* Return `int` or `float` if true or `null` if false */
pre($res);
```

### Null

```php
$res = Valid::isNull(null);

/* Return bool */
pre($res);
```

### Lowercase

You can validate a string if it is lowercase. If not, the `isLower` method will 
convert the string to lowercase. 

```php
$res = Valid::isLower('SOLITAL');

/* Return string */
pre($res);
```

### Uppercase

You can validate a string if it is uppercase. If not, the `isUpper` method will 
convert the string to uppercase. 

```php
$res = Valid::isUpper('solital');

/* Return string */
pre($res);
```

### Base64

Checks whether a variable is Base64-type encryption.

```php
$hash = base64_encode("test");
$res = Valid::isBase64($hash);

/* Return bool */
pre($res);
```

### Identical 

Checks if one variable is identical to another.

```php
$res = Valid::identical("foo", "foo");

/* Return bool */
pre($res);
```