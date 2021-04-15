## Password recovery structure

You can create a predefined password recovery framework. To do so, use the `php vinci forgot` command

This command creates a controller with the name `ForgotController`. With it you will have all the basis to create a password recovery system.

## Setting

Solital has a standard method for password recovery. For that, it is necessary to configure only the variable `MAIL_SENDER` in the file `.env`, inserting the sender and recipient.

This procedure uses the `forgot` method to define the database table. The `columns` method the form's email field. In the `values` method, the e-mail that will be sent the recovery link is informed in the first parameter, and in the second parameter the URL that will be contained in the e-mail to change the password. The `register` method will check and send the email.

```php
/**
 * @return void
 */
public function forgotPost(): void
{
    $email = input()->post('email')->getValue();

    $res = Auth::forgot('tb_auth')
            ->columns('username')
            ->values($email, url('change'))
            ->register();
    
    if ($res == true) {
        $this->message->new('forgot', 'Link sent to your email!');
        response()->redirect(url('forgot'));
    }
}
```

### Setting expiration time

By default, the link sent is valid for 1 hour. You can change this behavior using the `timeHash()` method.

```php
Auth::forgot('tb_auth')
    ->columns('username')
    ->values($email, url('change'))
    # Here the code
    ->timeHash('+2 hours')
    ->register();
```

### Using PHP Mailer

The password recovery procedure uses the native PHP class for sending e-mail. However, it is not always interesting to use this class, so you can use the `usePHPMailer()` method to send the email using PHP Mailer.

```php
Auth::forgot('tb_auth')
    ->columns('username')
    ->values($email, url('change'))
    # Here the code
    ->usePHPMailer()
    ->register();
```

If necessary, you can use `true` as a parameter to display PHP Mailer exceptions.

```php
# ...
->usePHPMailer(true)
# ...
```

### Changing email fields

By default, "User" is sent as the name of the sender and recipient. "Forgot Password" as the title of the email.

To change these fields, use the `fields()` function.

```php
Auth::forgot('tb_auth')
    ->columns('username')
    ->values($email, url('change'))
    # Here the code
    ->fields('name_sender', 'name_recipient', 'subject')
    ->register();
```

### Changing default email

If you need to change the default password recovery email, you must first use the `generateLink()` function. This function generates a new link in which the user will be redirected when changing the password.

First, it is necessary to inform the user's email, the route he will access to change the password, and the length of time that this link will be valid.

The code below shows an example of this use:

```php
$msg = "<h1>Retrieve your password</h1>";
$msg .= "<p>Click the link below to change your password</p>";
$msg .= "<a href='".generateLink($email, url('change'), '+2 hours')."'>Change Here!!</a>";

Auth::forgot('tb_auth')
    ->columns('username')
    ->values($email, url('change'))
    # Here the code
    ->fields('name_sender', 'name_recipient', 'subject', $msg)
    ->register();
```

## Validade link

To validate the information by clicking on the email link, you can use the structure below:

```php
/**
 * @param string $hash
 * 
 * @return void
 */
public function change($hash): void
{
    $res = Hash::decrypt($hash)->isValid();

    if ($res == true) {
        $email = Hash::decrypt($hash)->value();

        Wolf::loadView('auth.change-pass-form', [
            'title' => 'Change Password',
            'email' => $email,
            'hash' => $hash
        ]);
    } else {
        $this->message->new('login', 'The informed link has already expired!');
        response()->redirect(url('auth'));
    }
}
```

## Changing the password

This procedure uses the `change` method to define the database table. The `columns` method defines the database user and password fields. The `values` method defines the user's email in the first parameter, and the new password in the second parameter. The `register` method will check and change the email.

```php
Auth::change('tb_auth')
    ->columns('username', 'password')
    ->values($email, $pass)
    ->register();
```

