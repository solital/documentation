Helpers are functions that help the developer manipulate classes, without having to instantiate them.

Here you will find the helpers that exist in Solital Framework. Some specific helpers are not listed on this page, but you can find them on the next pages of the documentation.

Some helpers can be replaced by methods, as long as you use them inside a Controller.

## Debug

Debug functions are present in the [Modern PHP Exception component](https://github.com/brenno-duarte/modern-php-exception).

* An easy function to pull all details of the debug backtrace.

```php
get_debug_backtrace()
```

* Function to returns the value of var_dump() instead of outputting it.

```php
echo var_dump_buffer()
```

* PHP function to replace var_dump(), print_r() based on the XDebug style.

```php
var_dump_debug()
```

* Dump PHP value and die script.

```php
dump_die()
```

* View a PHP Closure's Source.

```php
closure_dump()
```

## Improved functions

* Generate a uniquid ID

```php
uniqid_real(int|float $lenght = 13)
```

## Instances

* Manipulate the `ArrayCollection` class without having to instantiate it.

```php
collection(mixed $value = null)
```

* Manipulate the `Str` class without having to instantiate it.

```php
str(string $string)
```

* Return a `SimpleCache` instance.

```php
cache(?string $drive)
```

* Convert an array to JSON and display an error message in case of failure.

```php
encodeJSON($value)
```

* Convert a JSON to an object and display an error message in case of failure. `true` to convert JSON to an array.

```php
decodeJSON($value, bool $toArray = false)
```

* Create a message using `Message` class without having to instantiate it

```php
message(string $key, string $msg = "")
```

* Cryptograph an value using `Hash` class without having to instantiate it

```php
encrypt(string $value, string $time = '+1 hour')
```

* Decryptograph an value using `Hash` class without having to instantiate it

```php
decrypt(string $key)
```

* Handles PHP sessions. 

To get a value from an existing session, leave the `$value` parameter empty. To create a new session, inform the session key in the first parameter, and the session value in the second parameter. See more [here](session.md).

```php
/**
 * $key: index that will identify the session
 * $value: session value
 * $defaultValue: array of values (see Session class documentation)
 * $delete: if the value is `true`, the session will be deleted.
 * $take: returns the requested value and removes it from the session.
 */
session(
    string $key, 
    mixed $value = null, 
    mixed $defaultValue = null, 
    bool $delete = false, 
    bool $take = false
)
```

* Memorize provides simple in-var cache for closures. It can be used to create lazy functions. Function takes closure and optional argument paramsHash. If the closure with the same arguments was run before memorize will return result from cache without the closure call. At the first call result will be calculated and stored in cache.

```php
memorize(Closure $lambda, $paramsHash = null)
```

* Create a Cookie instance (Available since Core 4.6.0)

```php
cookie(string $name)
```

## Output

* Formatted `var_dump`.

```php
pre($value)
```

* Write any message in the browser LOG, which can be viewed at any time.

```php
console_log(...$messages)
```

## Password

* Generate password hash using [PHP Secure Password](https://packagist.org/packages/brenno-duarte/php-secure-password) component.

```php
pass_hash($password, int $cost = 10)
```

* Checks the hash generated by the `pass_hash` helper or the [PHP Secure Password](https://packagist.org/packages/brenno-duarte/php-secure-password) component.

```php
pass_verify($password, string $hash)
```

## Reflection

* Get attributes' method.

```php
reflection_get_attributes(object|string $class_name, string|null $method, string $attribute_name)
```

* Gets a ReflectionProperty for a class's property.

```php
reflection_get_property(string|object $class, string $property)
```

* Reports information about an extension.

```php
reflection_extension_info(string $extension_name)
```

* Creates a new class instance from given arguments.

```php
reflection_new_instance(object|string $objectOrClass, ...$args)
```

* Creates a new class instance without invoking the constructor.

```php
reflection_instance_without_construct(object|string $objectOrClass)
```

* Invokes a reflected method

```php
reflection_invoke_method(object|string $objectOrClass, string $method, ...$args)
```

## Router

* Handles the URI class. See more in [routes](routes.md).

```php
url(?string $name = null, $parameters = null, ?array $getParams)
```

* Get input class. See more in [Input and params](input-and-params.md).

```php
input(string $index = null, string $defaultValue = null, ...$methods)
```

* Redirect to another route.

```php
to_route(string $url, ?int $code = null)
```

* Get the current full URL.

```php
get_url(string $uri = null)
```

* Get a middleware

```php
middleware(string $value)
```

## Server

* Handles the Request class.

```php
request()
```

* Handles the Response class.

```php
response()
```

* Defines a limit on requests that can be made at a certain time .

```php
request_limit(string $key, int $limit = 5, int $seconds = 60)
```

* Checks if a value was previously sent in the requisition.

```php
request_repeat(string $key, string $value)
```

* Removes GET parameters in the URL and reloads the page without those parameters.

```php
remove_param()
```

* Returns the IP address of the client.

```php
get_client_ip(?bool $header_containing_ip_address = null)
```

* Check to see if the current page is being served over SSL.

```php
is_https()
```

* Determine if current page request type is ajax.

```php
is_ajax()
```

## Wolf Template

See [Wolf Template](wolf-template.md) to use Wolf helpers.

* Load a CSS file into the `public/assets/_css/` folder.

```php
load_css(string $asset)
```

* Loads the minified CSS file created by the `minify()->style()` method.

```php
load_min_css()
```

* Load a Javascript file into the `public/assets/_js/` folder.

```php
load_js(string $asset)
```

* Loads the minified Javascript file created by the `minify()->script()` method.

```php
load_min_js()
```

* Load a image file into the `public/assets/_img/` folder.

```php
load_img(string $asset)
```

* Load a file into the `public/assets/` folder.

```php
load_file(string $asset)
```

* Includes any template that is inside the resource/view folder

```php
extend(string $view)
```

* Displayed code only in production mode or only in development mode

```php
conditional(string $needle, bool $value)
```

* Get current csrf-token. See more in [CSRF Protection](csrf-protection.md).

```php
csrf_token()
```

* Form method spoofing.

```php
spoofing(string $method)
```

## Others

* Returns the container defined in the `ServiceContainer` class.

```php
container(string $container_name)
```