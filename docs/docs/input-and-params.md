Solital offers libraries and helpers that makes it easy to manage and manipulate input-parameters like `$_POST`, `$_GET` and `$_FILE`.

You can use the `InputHandler` class to easily access and manage parameters from your request. The `InputHandler` class offers extended features such as copying/moving uploaded files directly on the object, getting file-extension, mime-type etc.

## Get single parameter value


```php
# With Helper
input($index, $defaultValue, ...$methods);

# With method
$this->getRequestParams($index, $defaultValue, ...$methods);
```

To quickly get a value from a parameter, you can use the `input` helper function or the `getRequestParams` method. The `getRequestParams` method can only be used inside a Controller.

This will automatically trim the value and ensure that it's not empty. If it's empty the `$defaultValue` will be returned instead.

**Note:** 
This function returns a `string` unless the parameters are grouped together, in that case it will return an `array` of values.

**Example:**

This example matches both POST and GET request-methods and if name is empty the default-value "Guest" will be returned. 

```php
#With helper
$name = input('name', 'Guest', 'post', 'get');

# With method
$name = $this->getRequestParams('name', 'Guest', 'post', 'get');
```

## Get parameter object

When dealing with file-uploads it can be useful to retrieve the raw parameter object.

**Search for object with default-value across multiple or specific request-methods:**

The example below will return an `InputItem` object if the parameter was found or return the `$defaultValue`. If parameters are grouped, it will return an array of `InputItem` objects.

```php
#With Helper
$object = input()->find($index, $defaultValue = null, ...$methods);

# With method
$object = $this->getRequestParams()->find($index, $defaultValue = null, ...$methods);
```

**Getting specific `$_GET` parameter as `InputItem` object:**

The example below will return an `InputItem` object if the parameter was found or return the `$defaultValue`. If parameters are grouped, it will return an array of `InputItem` objects.

```php
# With Helper
$object = input()->get($index, $defaultValue = null);

# With method
$object = $this->getRequestParams()->get($index, $defaultValue = null);
```

**Getting specific `$_POST` parameter as `InputItem` object:**

The example below will return an `InputItem` object if the parameter was found or return the `$defaultValue`. If parameters are grouped, it will return an array of `InputItem` objects.

```php
# With Helper
$object = input()->post($index, $defaultValue = null);

# With method
$object = $this->getRequestParams()->post($index, $defaultValue = null);
```

**Getting specific `$_FILE` parameter as `InputFile` object:**

The example below will return an `InputFile` object if the parameter was found or return the `$defaultValue`. If parameters are grouped, it will return an array of `InputFile` objects.

```php
# With Helper
$object = input()->file($index, $defaultValue = null);

# With method
$object = $this->getRequestParams()->file($index, $defaultValue = null);
```

## Managing files

Below you will find some code to help you upload files in a quick way.

```php
/**
 * From a form on the page like this
 * <input type="file" name="images" />
 * 
 * Only file
 */
$ext = input()->file('image')->getExtension();
$imgMain = 'IMG-'.uniqid().".".$ext;
input()->file('image')->move(dirname(__DIR__).'/photos/'.$imgMain);

/**
 * Loop through a collection of files uploaded from a form on the page like this
 * <input type="file" name="images[]" multiple />
 * 
 * Multiple files
 */
foreach ($photo as $photo) {
    $ext = $photo->getExtension();
    $img = 'IMG-'.uniqid().".".$ext;
    $photo->move(dirname(__DIR__).'/photos/'.$img);
}
```

Or, if you use the `getRequestParams` method:

```php
/**
 * Only file
 */
$ext = $this->getRequestParams()->file('image')->getExtension();
$imgMain = 'IMG-'.uniqid().".".$ext;
$this->getRequestParams()->file('image')->move(dirname(__DIR__).'/photos/'.$imgMain);

/**
 * Multiple files
 */
foreach ($photo as $photo) {
    $ext = $photo->getExtension();
    $img = 'IMG-'.uniqid().".".$ext;
    $photo->move(dirname(__DIR__).'/photos/'.$img);
}
```

## Get all parameters

In array:

```php
# Get all
$values = input()->all();

# Only match specific keys
$values = input()->all([
    'company_name',
    'user_id'
]);
```

In JSON:

```php
$values = input()->getAllJson();
```

All object implements the `InputItemInterface` interface and will always contain these methods:

- `getIndex()` - returns the index/key of the input.
- `getName()` - returns a human friendly name for the input (company_name will be Company Name etc).
- `getValue()` - returns the value of the input.

`InputFile` has the same methods as above along with some other file-specific methods like:

- `getFilename` - get the filename.
- `getTmpName()` - get file temporary name.
- `getSize()` - get file size.
- `move($destination)` - move file to destination.
- `getContents()` - get file content.
- `getType()` - get mime-type for file.
- `getError()` - get file upload error.
- `hasError()` - returns `bool` if an error occurred while uploading (if `getError` is not 0).
- `toArray()` - returns raw array