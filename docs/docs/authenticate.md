## Defining the routes

You can define dashboard and login routes. The dashboard route will be for when the user authenticates, and the login route will be for when the user logs off and will be redirected to it.

To do this, open the `auth.yaml` file and edit the `auth_dashboard_url` and `auth_login_url` variables.

```yaml
auth:
  auth_dashboard_url: /dashboard
  auth_login_url: /auth
```

### Setting

For this, it is necessary to first define the name of the table in the `login` method. In the `columns` method, the database username and password. Then, in the `values` method, the input values of the form. Finally, the `register` method will perform the login as shown below.

```php
$res = Auth::login('auth_users')
    ->columns('username', 'password')
    ->values('inputEmail', 'inputPassword')
    ->register();
```

You can also use the Model name in the `login()` method. This way, the `Auth` component will get the name of the table that is in the `$table` property.

Solital uses the default Model `AuthModel`. However, you can create a model and use it in the `login()` method.

```php
use Solital\Core\Kernel\Model\AuthModel;

$res = Auth::login(AuthModel::class)
    ->columns('username', 'password')
    ->values('inputEmail', 'inputPassword')
    ->register();
```

The `$res` variable will return `true` if authentication is true and will redirect the user to the route defined in the `auth_dashboard_url` variable. But if it is `false`, you can add a reply message after the above code if authentication fails.

```php
if ($res == false) {
    message('login', 'Invalid username and/or password!');
    response()->redirect('your_login_url');
}
```

### Remembering authentication

In some cases the user wants to remain logged into the system after closing the browser. When registering a user, you can first use the `remember` method, passing the name of the form input as a parameter.

In the `value` of the form input, use `true`.

```php
<input type="checkbox" name="inputRemember" value="true">

$res = Auth::login(AuthModel::class)
    ->columns('username', 'password')
    ->values('inputEmail', 'inputPassword')
    ->remember('inputRemember')
    ->register();
```


Below is an example method of authentication.

```php
<input type="email" name="inputEmail">
<input type="password" name="inputPassword">
<input type="checkbox" name="inputRemember" value="true">

<?php

namespace Solital\Components\Controller;

use Solital\Core\Http\Controller\Controller;
use Solital\Core\Auth\Auth;

class UserController extends Controller
{
    /**
     * @return void
     */
    public function authPost(): void
    {
        $res = Auth::login(AuthModel::class)
            ->columns('username', 'password')
            ->values('inputEmail', 'inputPassword')
            ->remember('inputRemember')
            ->register();

        if ($res == false) {
            message('login', 'Invalid username and/or password!');
            response()->redirect(url('auth'));
        }
    }

}
```

### Changing default routes

If you need more routes for dashboards and logins, you can change the parameter in the `register()` function:

```php
# In routers.php

Course::get('/my-second-dashboard', 'SiteController@SecondDashboard')->name('second.dashboard');

# In Controller with `url()` helper

$res = Auth::login(AuthModel::class)
    ->columns('username', 'password')
    ->values('inputEmail', 'inputPassword')
    ->register(url('second.dashboard'));

# Or without `url()` helper

$res = Auth::login(AuthModel::class)
    ->columns('username', 'password')
    ->values('inputEmail', 'inputPassword')
    ->register('/my-second-dashboard');
```

### Check login

To check if the user exists, you can create a middleware and add the `Auth::check()` method.

```php
class AuthMiddleware implements BaseMiddlewareInterface
{
	public function handle(): void
	{
        Auth::check();
	}
}
```

The `Auth::check` method checks whether there is a user authenticating, but if you want to specify a user, you can pass the username in the first parameter.

If the user is not authenticated, he will be redirected to the route defined in the `auth_login_url` variable. If you want to redirect to another route, you can define it using the second parameter.

```php
Auth::check('solital@egmail.com');

// Redirect to another router
Auth::check('solital@egmail.com', '/redirect-to-another-router');
```

## Logoff

To logoff, use the `Auth::logoff()` method.

```php
Auth::logoff();

// Logoff an user
Auth::logoff('solital@egmail.com');

// Redirect to another router
Auth::logoff('solital@egmail.com', '/redirect-to-another-router');
```

## Standard login structure 

To create a predefined login structure, use `php vinci auth:skeleton --login`

This command will create a `LoginController` class, `AuthMiddleware` middleware, templates for authentication, dashboard and predefined routes. Plus a standard user in the database.

If you want to remove this structure, use `php vinci auth:skeleton --login --remove`.

## Authentication using Sodium encryption

You can create an authentication using Sodium encryption.

**Generating a sodium key**

First, you need to generate a sodium key. This key is automatically renewed with each new request, so it can be stored in a database, in the session or in another type of storage.

```php
use Solital\Core\Security\Hash;

$key = Hash::getSodiumKey();
```

**Encrypting the password**

Use `Auth::sodium()` to encrypt your password. Remember to use it in conjunction with the generated key.

```php
use Solital\Core\Auth\Auth;
use Solital\Core\Security\Hash;

$key = Hash::getSodiumKey();
$encoded = Auth::sodium('password', $key);

pre($encoded);
```

**Verifying the password with Sodium**

To verify the password generated using the `Auth::sodium()` method, use `Auth::sodiumVerify()` together with the generated key, password and hash.

```php
use Solital\Core\Auth\Auth;
use Solital\Core\Security\Hash;

$key = Hash::getSodiumKey();
$encoded = Auth::sodium('password', $key);
$decoded = Auth::sodiumVerify($encoded, 'password', $key);

pre($decoded);
```