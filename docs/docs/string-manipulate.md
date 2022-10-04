This will make living with PHP strings easier by;
- providing a simple chained API to string operations
- not mixing up the needle haystack stuff
- allowing you to extend and add your own methods in seconds

```php
$text = 'Something to translate';
$text = strtr($text, $translation);
$text = htmlspecialchars($text);
$text = nl2br($text);
echo $text;
```

Str objects allow you this;

```php
use Solital\Core\Resource\Str\Str;

echo (new Str('Something to translate'))
	->translate($translation)
	->chars()
	->nl2br();

// Or use a helper `str()`

echo str('Something to translate')
	->translate($translation)
	->chars()
	->nl2br();
```

## `value()`

Returns the current value of this string

```php
$str = new Str('foo');
echo $str->value();
```

## `addCslashes()`

Quote string with slashes in a C style

```php
$str = new Str('testescape');
$str->addCslashes('acep');
echo $str->value();
```

## `addSlashes()`

Quote string with slashes

```php
$str = new Str("aa'bb");
$str->addSlashes();
echo $str->value();
```

## `chunkSplit()`

Splits the string into smaller chunks

```php
$str = new Str('foobar');
$str->chunkSplit(2, ':');
echo $str->value();
```

## `compare()`

Binary safe string comparison. 

* `<` 0 if this string is less than target string
* `>` 0 if this string is greater than target string
* `==` 0 if both strings are equal

```php
$str = new Str('my_string');
echo $str->compare('mystring');
```

## `compareInsensitive()`

Binary safe case-insensitive string comparison.

* `<` 0 if this string is less than target string
* `>` 0 if this string is greater than target string
* `==` 0 if both strings are equal

```php
$str = new Str('my_string');
echo $str->compareInsensitive('mystring');
```

## `concat()`

Appends another string to this string.

```php
$str = new Str('foo');
$str->concat('bar');
echo $str->value();
```

## `contains()`

Does current string contain a subtring?

```php
$str = new Str('my_string');
echo $str->contains('string');
```

## `countChars()`

Return information about characters used in a string.

```php
$str = new Str('abababcabc');
$res = $str->countChars(true);

pre($res);
```

## `explode()`

Splits current string by string.

```php
$str = new Str('but_Bar_is_never_Foo');
$res = $str->explode('_');

pre($res);
```

## `implode()`

Join array elements with this string.

```php
$str = new Str('!');
$res = $str->implode(['foo', 'is', 'bar', 'sometimes']);

pre($res);
```

## `ireplace()`

Case-insensitive version of Str::replace().

```php
$str = new Str('foo=bar');
$str->ireplace(['FOO' => 'bar']);
echo $str->value();
```

## `ltrim()`

Strip whitespace (or other characters) from the beginning of a string.

```php
$str = new Str('_-_foo');
$str->ltrim('_-');
echo $str->value();
```

## `nl2br()`

Converts new lines to `<br />` elements.

```php
$str = new Str(["foo\nbar" . PHP_EOL, "foo<br />\nbar<br />" . PHP_EOL]);
$str->nl2br();
echo $str->value();
```

## `pad()`

Pad the string to a certain length with another string.

* `$pad_length`: If the value of pad_length is negative, less than, or equal to the length of current string, no padding takes place
* `$pad_string`: String to pad the current string with
* `$pad_type`: Optional, can be `STR_PAD_RIGHT`, `STR_PAD_LEFT`, or `STR_PAD_BOTH`. If `$pad_type` is not specified it is assumed to be `STR_PAD_RIGHT`

```php
$str = new Str('foo');
$str->pad(16, '-.-;', STR_PAD_RIGHT);
echo $str->value();
```

## `position()`

Find the position of the first occurrence of a substring in a string.

```php
$str = new Str('foo is bar sometimes');
$str->position(' is ', 0);
echo $str->value();
```

## `repeat()`

Repeats the string.

```php
$str = new Str('foo');
$str->repeat(5);
echo $str->value();
```

## `replace()`

Replaces the occurences of keys with their values.

```php
$str = new Str('foo can be bar but foo does not have to');
$str->replace(['foo' => 'fOo', 'DoEs Not' => 'fail', 'to' => '2']);
echo $str->value();
```

## `reverse()`

Reverses current string.

```php
$str = new Str('knitS raW pupilS regaL');
$str->reverse();
echo $str->value();
```

## `rot13()`

Perform the ROT13 transform on current string.
    
The ROT13 encoding simply shifts every letter by 13 places in the alphabet while leaving non-alpha characters untouched. Encoding and decoding are done by the same function, passing an encoded string as argument will return the original version.

```php
$str = new Str('foobar');
$str->rot13();
echo $str->value();
```

## `rtrim()`

Strip whitespace (or other characters) from the end.

```php
$str = new Str('ofoooooo');
$str->rtrim('o');
echo $str->value();
```

## `shuffle()`

Randomly shuffles the string.

```php
$str = new Str('foo bar foobar pebkac fubar');
$original = $str->value();
$str->shuffle();
echo $str->value();
echo $original;
```

## `specialchars()`

Convert special characters to HTML entities.

* `$decode`: If `true`, convert special HTML entities back to characters.

```php
$str = new Str('<p>This should <br>not be wrapped</p>');
$str->specialchars();
echo $str->value();
```

## `stripTags()`

Strip HTML and PHP tags.

* `$allowable_tags`: List of allowed tags.

```php
$str = new Str('<html><div><p><br/><br></p></div></html>');
$str->stripTags();
echo $str->value();
```

## `translate()`

Translate characters or replace substrings.

```php
$str = new Str(':foo :bar');
$str->translate([':foo' => ':bar', ':bar' => ':newbar']);
echo $str->value();
```

## `trim()`

Strips whitespace (or other characters) from the beginning and end of the string.

```php
$str = new Str('offsoooooo');
$str->trim('o');
echo $str->value();
```

## `undo()`

Undoes the last `$steps` operations.

```php
$str = new Str(' foo is bar ');
$str->rtrim();
$str->ltrim();
$str->replace(array(' is ' => '_is_'));
$str->undo(1);
echo $str->value();
```

## `uniqueChars()`

Returns a string containing all unique characters (in current string).

```php
$str = new Str('abcabdabcd');
$str->uniqueChars();
echo $str->value();
```

## `wordCount()`

Counts the number of words inside string.

* `$charlist`: Optional list of additional characters which will be considered as 'word'.

```php
$str = new Str('foo is here 3 times foo foo');
$str->wordCount();
echo $str->value();
```

## `word()`

Returns the list of words inside string.

* `$charlist`: Optional list of additional characters which will be considered as 'word'.

```php
$str = new Str('foo foo bar foo');
$str->word();
echo $str->value();
```