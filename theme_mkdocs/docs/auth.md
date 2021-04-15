At first, you have the option to change the index where Solital will store the login in the `.env` file. 

```bash
INDEX_LOGIN='solital_index_login'
```

## Setting

For this, it is necessary to first define the name of the table in the `login` method. In the `columns` method, the database username and password. Then, in the `values` method, the input values of the form. Finally, the `register` method will perform the login as shown below.

```php
$res = Auth::login('tb_auth')
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

use Solital\Components\Controller\Controller;
use Solital\Core\Auth\Auth;

class UserController extends Controller
{
    /**
     * @return void
     */
    public function authPost(): void
    {
        $res = Auth::login('tb_auth')
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

## Standard login and dashboard

In some cases, your project may have more than one type of login such as e-commerce or multiple logins. Obviously, it is necessary to have several different login and dashboard routes.

You can define these routes for each Controller using the `Auth::defineUrl()` method, passing the login route in the first parameter, and the dashboard route in the second.

If this method is not declared, the `/auth` and `/dashboard` routes will be used by default.

Remember, always declare this method in the class's constructor.

```php
/**
 * Construct
 */
public function __construct()
{
    Auth::defineUrl('/custom-login', '/custom-dashboard');
}

```

## Check login

To ensure that the user is authenticated, use the `Auth::isNotLogged()` method. If the login has not been validated, the user will be redirected to the route defined in the `Auth::defineUrl()` method or to the `/login` route. The example below shows the method together with the Wolf model.

```php
Auth::isNotLogged()
            
Wolf::loadView('home');
```

To ensure that the user doesn't fall into the login route when it has already been validated, insert the `Auth::isLogged()` method in your login route. This method will redirect the user to your system's dashboard.

```php
Auth::isLogged();

Wolf::loadView('login');
```

## Log off
To log off, use the `Auth::logoff()` method.

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

To create a predefined login structure, use `php vinci auth`

This command will create a `LoginController` class, templates for authentication, dashboard and predefined routes. Plus a standard user in the database. To learn more visit [this link](https://solital.github.io/docs-v1/auth).

If you want to remove this structure, use `php vinci remove-auth`