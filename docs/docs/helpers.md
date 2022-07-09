## HTTP

- Handles the URI class. See more in [routes](routes.md).

```php
/**
 * @param string $name
 * @param mixed $parameters
 * @param null|array $getParams
*/
url(?string $name = null, $parameters = null, ?array $getParams)
```

- Handles the Response class.

```php
response()
```

- Handles the Request class.

```php
request()
```

- Get input class. See more in [Input and params](input-and-params.md).

```php
/**
 * @param string|null $index: Parameter index name
 * @param string|null $defaultValue: Default return value
 * @param array ...$methods: Default methods
 * 
 * @return mixed
 */
input(string $index = null, string $defaultValue = null, ...$methods)
```

- Redirect to another route.

```php
/**
 * @param string $url: the route to which you will be redirected
 * @param int|null $code: HTTP code
 */
redirect(string $url, ?int $code = null)
```

- Defines a limit on requests that can be made at a certain time 

```php
/**
 * @param string $key: key to identify the requisition 
 * @param int $limit: number of times the request can be made
 * @param int $seconds: waiting time until it is possible to make the request again. 
 * 
 * @return bool
*/
request_limit(string $key, int $limit = 5, int $seconds = 60)
```

- Checks if a value was previously sent in the requisition.

```php
/**
 * @param string $key: key to identify the requisition 
 * @param string $value: value that will be added
 * 
 * @return bool
 */
request_repeat(string $key, string $value)
```

## Security

- Get current csrf-token. See more in [CSRF Protection](csrf-protection.md).

```php
csrf_token()
```

- Form method spoofing.

```php
/**
 * @param string $method: GET, POST, PUT or DELETE
*/
spoofing(string $method)
```

- Similar to `password_hash`.

```php
/**
 * @param mixed $value: the user's password. 
 * @param int $cost: which denotes the algorithmic cost that should be used.
*/
pass_hash($value, int $cost = 10)
```

- Similar to `password_verify`.

```php
/**
 * @param mixed $value: the user's password. 
 * @param string $hash: a hash created by `pass_hash()`.
*/
pass_verify($value, string $hash)
```

## Wolf Template

- See [Wolf Template](wolf-template.md) to use Wolf helpers.

- Load a CSS file into the `public/assets/_css/` folder.

```php
/**
 * @param string $asset: CSS file name
*/
loadCss(string $asset)
```

- Loads the minified CSS file created by the `minify()->style()` method.

```php
loadMinCss()
```

- Load a Javascript file into the `public/assets/_js/` folder.

```php
/**
 * @param string $asset: javascript file name
*/
loadJs(string $asset)
```

- Loads the minified Javascript file created by the `minify()->script()` method.

```php
loadMinJs()
```

- Load a image file into the `public/assets/_img/` folder.

```php
/**
 * @param string $asset: image file name
*/
loadImg(string $asset)
```

- Load a file into the `public/assets/` folder.

```php
/**
 * @param string $asset: external file name
*/
loadFile(string $asset)
```

## Output

- Formatted `var_dump`.

```php
/**
 * @param mixed $value: to format
*/
pre($value)
```

- `cloner` uses Symfony `VarCloner` function. [See more](https://symfony.com/doc/current/components/var_dumper/advanced.html).

```php
/**
 * @param mixed $var
 */
cloner($var)
```

- Displays the variable formatted in string. `true` to return as an array.

```php
/**
 * @param mixed $var
 * @param bool $length
 */
dumper($var, bool $length = false)
```

- It is possible to make use of Symfony `dump` function.

```php
dump($var)
```

- `export` uses the Symfony `VarExport` function. [See more](https://symfony.com/doc/current/components/var_exporter.html).

```php
/**
 * @param mixed $value
 */
export($value)
```

- Convert an array to JSON and display an error message in case of failure.

```php
/**
 * @param mixed $value: to JSON
*/
encodeJSON($value)
```

- Convert a JSON to an object and display an error message in case of failure. `true` to convert JSON to an array.

```php
/**
 * @param mixed $value: to JSON
 * @param bool $toArray: convert JSON object in array
*/
decodeJSON($value, bool $toArray = false)
```

- Write any message in the browser LOG, which can be viewed at any time.

```php
/**
 * @param mixed ...$messages
 * 
 * @return void
 */
console_log(...$messages)
```

## Others

- Removes GET parameters in the URL and reloads the page without those parameters.

```php
remove_param()
```

- Check if variable is JSON.

```php
/**
 * @param mixed $string: verify if value is JSON
*/
is_json($string)
```

- Get the current full URL.

```php
/**
 * @param string $uri
 */
get_url(string $uri = null)
```

- Handles PHP sessions. To get a value from an existing session, leave the `$value` parameter empty. To create a new session, inform the session index in the first parameter, and the session value in the second parameter.

```php
/**
 * @param string $index: index that will identify the session
 * @param mixed $value: session value
 * @param null|string $key: array of values (see Session class documentation)
 * @param bool $delete: if the value is `true`, the session will be deleted.
 * 
 * @return mixed
 */
session(string $index, $value = null, ?string $key = null, bool $delete = false)
```