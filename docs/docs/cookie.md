## Static method

This library provides a static method that is compatible to PHP’s built-in `setcookie(...)` function but includes support for more recent features such as the `SameSite` attribute:

```php
use Solital\Core\Resource\Cookie;

Cookie::setcookie('SID', '31d4d96e407aad42');
// or
Cookie::setcookie('SID', '31d4d96e407aad42', time() + 3600, '/~rasmus/', 'example.com', true, true, 'Lax');
```

## Builder pattern

Instances of the `Cookie` class let you build a cookie conveniently by setting individual properties. This class uses reasonable defaults that may differ from defaults of the `setcookie` function.

```php
$cookie = new Cookie('SID');
$cookie->setValue('31d4d96e407aad42');
$cookie->setMaxAge(60 * 60 * 24);
// $cookie->setExpiryTime(time() + 60 * 60 * 24);
$cookie->setPath('/~rasmus/');
$cookie->setDomain('example.com');
$cookie->setHttpOnly(true);
$cookie->setSecureOnly(true);
$cookie->setSameSiteRestriction('Strict');

// echo $cookie;
// or
$cookie->save();
// or
// $cookie->saveAndSet();
```

The method calls can also be chained:

```php
(new Cookie('SID'))
    ->setValue('31d4d96e407aad42')
    ->setMaxAge(60 * 60 * 24)
    ->setSameSiteRestriction('None')
    ->save();
```

### Delete cookie

A cookie can later be deleted simply like this:

```php
$cookie->delete();
// or
$cookie->deleteAndUnset();
```

**Note:** For the deletion to work, the cookie must have the same settings as the cookie that was originally saved – except for its value, which doesn’t need to be set. So you should remember to pass appropriate values to `setPath(...)`, `setDomain(...)`, `setHttpOnly(...)` and `setSecureOnly(...)` again.

## Reading cookies

* Checking whether a cookie exists:

```php
Cookie::exists('first_visit');
```

* Reading a cookie’s value (with optional default value):

```php
Cookie::get('first_visit');
// or
Cookie::get('first_visit', time());
```

## Parsing cookies

```php
$cookieHeader = 'Set-Cookie: test=php.net; expires=Thu, 
09-Jun-2016 16:30:32 GMT; Max-Age=3600; path=/~rasmus/; secure';
$cookieInstance = Cookie::parse($cookieHeader);
```