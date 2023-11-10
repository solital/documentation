You can manipulate JSON using the `JSON` class or using the helpers `encodeJSON` and `decodeJSON`.

The difference of this class for `json_encode` and `json_decode` is that you can automatically view errors when encoding/decoding a JSON, in addition to looking for a value within a JSON and reading external files.

There are two ways to use this class, using the helpers mentioned above, or by instantiating the `JSON` class. 

```php
# Instantiating the JSON class

use Solital\Core\Resource\JSON;

$json = new JSON();

# Using the helpers encodeJSON and decodeJSON 

encodeJSON($json);
decodeJSON($json);
```

## Predefined Constants

By default, the `JSON_UNESCAPED_UNICODE` constant is defined in the constructor of the `JSON` class or the helper `encodeJSON`. It is possible to add more than one constant following the model below: 

```php
# Class
$json = new JSON(JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

# Helper
encodeJSON($json, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
```

## Encode JSON

The `encode` method creates a JSON from an array, or use the `encodeJSON` helper.

```php
$array = ["name" => "Adithýa", "age" => 20];

# Class
$json = new JSON();
$res = $json->encode($array);

# Helper
$res = encodeJSON($array);

/* Return JSON */
pre($res);
```

## Decode JSON

The `decode` method decodes JSON into an object or array. 

```php
$json_file = '{"Organization": "PHP Documentation Team"}';

# Class
$json = new JSON();
$res = $json->decode($json_file);

# Helper
$res = decodeJSON($json_file);

/* Return object */
pre($res);
```

To return an associative array, use `true` in the second parameter.

```php
$json_file = '{"Organization": "PHP Documentation Team"}';

# Class
$json = new JSON();
$res = $json->decode($json_file, true);

# Helper
$res = decodeJSON($json_file, true);

/* Return array */
pre($res);
```

## Returning a value in JSON

If you need to read a value from the JSON file, use the `inJson` method. Inform JSON in the first parameter and the name of the key that contains the value in the second parameter. 

```php
$json_file = '{"Organization": "PHP Documentation Team"}';

$json = new JSON();
$res = $json->inJson($json , 'Organization');

/* Return string */
pre($res);
```

## Read an external JSON file

If you want to read an external file, use `readFile`. This method works in a similar way to the `decode` method. 

```php
$json_file = '{"Organization": "PHP Documentation Team"}';

$json = new JSON();
$res = $json->readFile('data.json');

/* Return object */
pre($res);
```

**Returning in array**

```php
$json_file = '{"Organization": "PHP Documentation Team"}';

$json = new JSON();
$res = $json->readFile('data.json', true);

/* Return array */
pre($res);
```

## Returning errors

A JSON containing the type of error is returned whenever there is a failure to code or 
decode a JSON. Below is an example of how it is returned: 

```json
{
    "json_error": "Syntax error, malformed JSON"
}
```

## Enabling Exceptions

To enable exceptions in case there is a Json reading error, change the value of the `json_exception` key to `true`. You can find this key in the `bootstrap.yaml` configuration file.

```yaml
json_exception: true
```