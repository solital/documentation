`StrMask` is a Solital class to make masks for a string

In your PHP application, use the static method `apply` of Mask:

```php
use Solital\Core\Resource\Str\StrMask;

$output = StrMask::apply($inputValue, $maskExpression, $config);
```

## Arguments

* `$inputValue`: string - The input value to apply mask.
* `$maskExpression`: string - The mask expression for $output.
* `$config`: array - The configuration for operation

### Patterns

The patterns are used to filter $inputValue:

<table class="table">
    <thead>
        <tr>
        <th scope="col">Code</th>
        <th scope="col">Meaning</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span class="cmd-vinci">**0**</span></td>
            <td>digits (like 0 to 9 numbers)</td>
        </tr>
		<tr>
            <td><span class="cmd-vinci">**9**</span></td>
            <td>digits (like 0 to 9 numbers), but optional</td>
        </tr>
		<tr>
            <td><span class="cmd-vinci">**A**</span></td>
            <td>letters (uppercase or lowercase) and digits</td>
        </tr>
		<tr>
            <td><span class="cmd-vinci">**S**</span></td>
            <td>only letters (uppercase or lowercase)</td>
        </tr>
	</tbody>
</table>

### Special chars

Special chars are used in mask expressions to format output:

* /
* (
* )
* .
* :
* -
* **space**
* +
* ,
* @

### Thousand separator

You can format a number in thousand separator and control precision.

The mask keys are:

* `separator`: Input `1234.56` is ouputed as `1 234.56`
* `dot_separator`: Input `1234,56` is ouputed as `1.234,56`
* `comma_separator`: Input `1234.56` is ouputed as `1,234.56`

To manage precision, keys shall be suffixed by `.{Number}`.

Example:

* `separator.1`: Input `1234.56743` is ouputed as `1 234.5`
* `dot_separator.4`: Input `1234,56743` is ouputed as `1.234,5674`
* `comma_separator.2`: Input `1234.56743` is ouputed as `1,234.56`

### Time validation

You can format a time according limit:

<table class="table">
    <thead>
        <tr>
        <th scope="col">Mask</th>
        <th scope="col">Meaning</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span class="cmd-vinci">**H**</span></td>
            <td>Input value shall be inside 0 and 2.</td>
        </tr>
		<tr>
            <td><span class="cmd-vinci">**h**</span></td>
            <td>Input value shall be inside 0 and 3.</td>
        </tr>
		<tr>
            <td><span class="cmd-vinci">**m**</span></td>
            <td>Input value shall be inside 0 and 4.</td>
        </tr>
		<tr>
            <td><span class="cmd-vinci">**s**</span></td>
            <td>Input value shall be inside 0 and 5.</td>
        </tr>
	</tbody>
</table>

### Percent validation

You can format a value from `$inputValue` as a percent and manage the precision. Use the key `percent` to have a extract value from `$inputValue` within 0 to 100. Suffix the key with `.{Number}` to manage precision (`percent.2`).

Example:

```php
$output = StrMask::apply("99.4125", "percent.2");

// $output contains: 99.41
```

### Prefix and suffix

You have possibility to set suffix and prefix in output:

```php
$output = StrMask::apply("0102030405", "00 00 00 00 00", [
  "prefix" => "My phone is ",
  "suffix" => "!"
]);

// $output contains: My phone is 01 02 03 04 05!
```