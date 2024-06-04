## Introduction

PHP has several functions to manipulate strings procedurally. However, this can be a hassle when it comes to using multiple functions to manipulate a single string. The situation gets worse when you have multibyte characters, as you will have to switch between functions.

```php
$text = 'Something to translate';
$text = strtr($text, $translation);
$text = htmlspecialchars($text);
$text = nl2br($text);
echo $text;
```

The `Str` component allows you to perform these same functions using OOP. This will make living with PHP strings easier by:

- providing a simple chained API to string operations
- not mixing up the needle haystack stuff
- allowing you to extend and add your own methods in seconds

### How to use

Below is an example of how to perform the functions in the previous example using the `Str` component:

```php
use Solital\Core\Resource\Str\Str;

$str = new Str('Something to translate');
$str->translate(["translate" => "another language"])
$str->specialchars()
$str->nl2br();

echo $str->value();

// Or use `__toString()`

echo $str;
```

If you don't want to create a new instance, you can use the `str()` helper:

```php
echo str('Something to translate')
	->translate(["translate" => "another language"])
	->specialchars()
	->nl2br();
```

The `Str` class is fully compatible with multibyte characters.

## Chained methods

The methods below must be used by creating an instance of the `Str` class.

### `value()`

Returns the current value of this string

```php
$str = new Str('foo');
echo $str->value();
```

### `after()`

Get the string after the first occurence of the substring.

```php
$str = new Str("This is a test");
$str->after("This is");
echo $str->value();
```

### `before()`

Get the string before the first occurence of the substring.

```php
$str = new Str("This is a test");
$str->before("a test");
echo $str->value();
```

### `addCslashes()`

Quote string with slashes in a C style

```php
$str = new Str('testescape');
$str->addCslashes('acep');
echo $str->value();
```

### `addSlashes()`

Quote string with slashes

```php
$str = new Str("aa'bb");
$str->addSlashes();
echo $str->value();
```

### `chunkSplit()`

Splits the string into smaller chunks

```php
$str = new Str('foobar');
$str->chunkSplit(2, ':');
echo $str->value();
```

### `concat()`

Appends another string to this string.

```php
$str = new Str('foo');
$str->concat('bar');
echo $str->value();
```

### `ireplace()`

Case-insensitive version of Str::replace().

```php
$str = new Str('foo=bar');
$str->ireplace(['FOO' => 'bar']);
echo $str->value();
```

### `ltrim()`

Strip whitespace (or other characters) from the beginning of a string.

```php
$str = new Str('_-_foo');
$str->ltrim('_-');
echo $str->value();
```

### `nl2br()`

Converts new lines to `<br />` elements.

```php
$str = new Str(["foo\nbar" . PHP_EOL, "foo<br />\nbar<br />" . PHP_EOL]);
$str->nl2br();
echo $str->value();
```

### `pad()`

Pad the string to a certain length with another string.

* `$pad_length`: If the value of pad_length is negative, less than, or equal to the length of current string, no padding takes place
* `$pad_string`: String to pad the current string with
* `$pad_type`: Optional, can be `STR_PAD_RIGHT`, `STR_PAD_LEFT`, or `STR_PAD_BOTH`. If `$pad_type` is not specified it is assumed to be `STR_PAD_RIGHT`

```php
$str = new Str('foo');
$str->pad(16, '-.-;', STR_PAD_RIGHT);
echo $str->value();
```

### `removeAccents()`

Replace characters with accents with normal characters.

```php
$str = new Str("àèìÒ");
$str->removeAccents();
echo $str->value();
```

### `repeat()`

Repeats the string.

```php
$str = new Str('foo');
$str->repeat(5);
echo $str->value();
```

### `replace()`

Replaces the occurences of keys with their values.

```php
$str = new Str('foo can be bar but foo does not have to');
$str->replace(['foo' => 'fOo', 'DoEs Not' => 'fail', 'to' => '2']);
echo $str->value();
```

### `reverse()`

Reverses current string.

```php
$str = new Str('knitS raW pupilS regaL');
$str->reverse();
echo $str->value();
```

### `rot13()`

Perform the ROT13 transform on current string.
    
The ROT13 encoding simply shifts every letter by 13 places in the alphabet while leaving non-alpha characters untouched. Encoding and decoding are done by the same function, passing an encoded string as argument will return the original version.

```php
$str = new Str('foobar');
$str->rot13();
echo $str->value();
```

### `rtrim()`

Strip whitespace (or other characters) from the end.

```php
$str = new Str('ofoooooo');
$str->rtrim('o');
echo $str->value();
```

### `shorten()`

Truncate String (shorten) with or without ellipsis.

```php
$str = new Str('foo bar foobar pebkac fubar');
$str->shorten(10);
echo $str->value();
```

### `shuffle()`

Randomly shuffles the string.

```php
$str = new Str('foo bar foobar pebkac fubar');
$original = $str->value();
$str->shuffle();
echo $str->value();
echo $original;
```

### `slug()`

Generate a URL friendly slug from the given string.

```php
$str = new Str('foo bar foobar pebkac fubar');
$str->slug();
echo $str->value();
```

### `specialchars()`

Convert special characters to HTML entities.

* `$decode`: If `true`, convert special HTML entities back to characters.

```php
$str = new Str('<p>This should <br>not be wrapped</p>');
$str->specialchars();
echo $str->value();
```

### `stripTags()`

Strip HTML and PHP tags.

* `$allowable_tags`: List of allowed tags.

```php
$str = new Str('<html><div><p><br/><br></p></div></html>');
$str->stripTags();
echo $str->value();
```

### `translate()`

Translate characters or replace substrings.

```php
$str = new Str(':foo :bar');
$str->translate([':foo' => ':bar', ':bar' => ':newbar']);
echo $str->value();
```

### `trim()`

Strips whitespace (or other characters) from the beginning and end of the string.

```php
$str = new Str('offsoooooo');
$str->trim('o');
echo $str->value();
```

### `toUpper()`

Make a string uppercase.

```php
$str = new Str('my string');
$str->toUpper();
echo $str->value();
```

### `toLower()`

Make a string uppercase.

```php
$str = new Str('MY STRING');
$str->toLower();
echo $str->value();
```

### `undo()`

Undoes the last `$steps` operations.

```php
$str = new Str(' foo is bar ');
$str->rtrim();
$str->ltrim();
$str->replace(array(' is ' => '_is_'));
$str->undo(1);
echo $str->value();
```

## Not chainable methods

The methods below must be used statically.

### `compare()`

Binary safe string comparison. 

* `<` 0 if this string is less than target string
* `>` 0 if this string is greater than target string
* `==` 0 if both strings are equal

```php
echo Str::compare('my_string', 'mystring');
```

### `compareInsensitive()`

Binary safe case-insensitive string comparison.

* `<` 0 if this string is less than target string
* `>` 0 if this string is greater than target string
* `==` 0 if both strings are equal

```php
echo Str::compareInsensitive('my_string', 'mystring');
```

### `contains()`

Does current string contain a subtring?

```php
echo Str::contains('my_string', 'string');
```

### `countChars()`

Return information about characters used in a string.

```php
$res = Str::countChars('abababcabc');
pre($res);
```

### `endsWith()`

Checks if haystack ends with needle

```php
echo Str::endsWith('foo is bar sometimes', 'sometimes');
```

### `position()`

Find the position of the first occurrence of a substring in a string.

```php
echo Str::position('foo is bar sometimes', ' is ', 0);
```

### `startsWith()`

Checks if haystack begins with needle

```php
echo Str::startsWith('foo is bar sometimes', 'foo');
```

### `uniqueChars()`

Returns a string containing all unique characters (in current string).

```php
echo Str::uniqueChars('abcabdabcd');
```

### `wordCount()`

Counts the number of words inside string.

* `$charlist`: Optional list of additional characters which will be considered as 'word'.

```php
echo Str::wordCount('foo is here 3 times foo foo');
```

### `word()`

Returns the list of words inside string.

* `$charlist`: Optional list of additional characters which will be considered as 'word'.

```php
echo Str::word('foo foo bar foo');
```