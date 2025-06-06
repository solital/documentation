The middleware in web applications is the mid-layer between the HTTP request and the application logic. The middleware process incoming requests and execute the code before the controller’s actions. One of the main functions is filtering HTTP requests from the user’s browser before the actual application logic.

## Create middleware

The process to create a Middleware is quite simple: you can use the Vinci Console to create a middleware class. This class will be stored in `app/Middleware/`.

Command:

```
php vinci create:middleware UserMiddleware
```

Class:
```php
<?php

namespace Solital\Middleware;

use Solital\Core\Http\Middleware\BaseMiddlewareInterface;

class UserMiddleware implements BaseMiddlewareInterface
{
    /**
     * @return void
     */
    public function handle(): void
    {
        // ...
    }
}
```

## Basic Middleware

To assign middleware to all routes within a group, you may use the middleware key in the group attribute array. Middleware are executed in the order they are listed in the array:

```php
Course::group(['prefix' => '/admin', 'middleware' => '\Solital\Middleware\UserMiddleware'], function ()
{
    Course::get("/login", "UserController@login")->name('login');
    Course::put("/logout", "UserController@logout")->name('logout');
});
```

## Use a helper

If you don't want to type the entire middleware namespace, you can configure it in the `middleware.yaml` file and use the `middleware` helper.

**middleware.yaml**

```yaml
middleware:
  login: UserMiddleware # Or: \Solital\Middleware\UserMiddleware
```

**routes.php**

```php
Course::group(['prefix' => '/admin', 'middleware' => middleware('login')], function ()
{
    Course::get("/login", "UserController@login")->name('login');
    Course::put("/logout", "UserController@logout")->name('logout');
});
```

## Adding Middleware

If you only have one route that needs to add middleware, use the `addMiddleware` method.

```php
Course::match(['get', 'post'], '/user/login', 'UserMiddleware@login')
    ->addMiddleware('\Solital\Middleware\UserMiddleware:guest');
```

## Restrict access to IP

You can white and/or blacklist access to IP's using the build in `IpRestrictAccess` middleware.

Create your own custom Middleware and extend the `IpRestrictAccess` class.

The `IpRestrictAccess` class contains two properties `ip_blocklist` and `ip_passlist` that can be added to your middleware to change which IP's that have access to your routes.

You can use `*` to restrict access to a range of ips.

```php
use Solital\Core\Http\Middleware\IpRestrictAccess;

class IpRestrictMiddleware extends IpRestrictAccess implements BaseMiddlewareInterface
{
	protected $ip_blocklist = [
        '5.5.5.5',
        '8.8.*',
    ];

    protected $ip_passlist = [
        '8.8.2.2',
    ];

	public function handle(): void
	{
		// ...
	}
}
```