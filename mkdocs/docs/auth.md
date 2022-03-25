At first, you have the option to change the index where Solital will store the login in the `.env` file. 

```bash
INDEX_LOGIN='solital_index_login'
```

## Setting

For this, it is necessary to first define the name of the table in the `login` method. In the `columns` method, the database username and password. Then, in the `values` method, the input values of the form. Finally, the `register` method will perform the login as shown below.

```php
$res = Auth::login('auth_users')
            ->columns('username', 'password')
            ->values('inputEmail', 'inputPassword')
            ->register();
```

The `$res` variable will return `true` if authentication is true. But if it is `false`, you can add a reply message after the above code if authentication fails.

```php
if ($res == false) {
    $this->message->new('login', 'Invalid username and/or password!');
    response()->redirect('your_login_url');
}
```

Below is an example method of authentication.

```php
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
        $res = Auth::login('auth_users')
            ->columns('username', 'password')
            ->values('inputEmail', 'inputPassword')
            ->register();

        if ($res == false) {
            $this->message->new('login', 'Invalid username and/or password!');
            response()->redirect(url('auth'));
        }
    }

}
```

## Check login

To ensure that the user is authenticated, use the Auth::isNotLogged() method. If the login has not been validated, the user will be redirected to the route defined in the `auth.yaml` file or to the `/login` route.

```php
/**
 * @return mixed
 */
public function dashboard(): mixed
{
    Auth::isNotLogged();

    return view('dashboard');
}
```

To ensure that the user doesn't fall into the login route when it has already been validated, insert the `Auth::isLogged()` method in your login route. This method will redirect the user to your system's dashboard.

```php
/**
 * @return mixed
 */
public function auth(): mixed
{
    Auth::isLogged();

    return view('login');
}
```

## Logoff

To logoff, use the `Auth::logoff()` method.

```php
/**
 * @return void
 */
public function exit(): void
{
    Auth::logoff();
}
```

## Standard login structure 

To create a predefined login structure, use `php vinci auth:skeleton --login`

This command will create a `LoginController` class, templates for authentication, dashboard and predefined routes. Plus a standard user in the database.

If you want to remove this structure, use `php vinci auth:skeleton --login --remove`.

## Authentication using Sodium encryption

You can create an authentication using Sodium encryption.

### Generating a sodium key

First, you need to generate a sodium key. This key is automatically renewed with each new request, so it can be stored in a database, in the session or in another type of storage.

```php
use Solital\Core\Security\Hash;

$key = Hash::getSodiumKey();
```

### Encrypting the password

Use `Auth::sodium()` to encrypt your password. Remember to use it in conjunction with the generated key.

```php
use Solital\Core\Auth\Auth;
use Solital\Core\Security\Hash;

$key = Hash::getSodiumKey();
$encoded = Auth::sodium('password', $key);

pre($encoded);
```

### Verifying the password with Sodium

To verify the password generated using the `Auth::sodium()` method, use `Auth::sodiumVerify()` together with the generated key, password and hash.

```php
use Solital\Core\Auth\Auth;
use Solital\Core\Security\Hash;

$key = Hash::getSodiumKey();
$encoded = Auth::sodium('password', $key);
$decoded = Auth::sodiumVerify($encoded, 'password', $key);

pre($decoded);
```