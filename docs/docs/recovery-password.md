## Setting

This procedure uses the `forgot` method to define the database table. The `columns` method the form's email field. In the `values` method, the e-mail that will be sent the recovery link is informed in the first parameter, and in the second parameter the URL that will be contained in the e-mail to change the password. The `register` method will check and send the email.

```php
/**
 * @return void
 */
public function forgotPost(): void
{
    $email = input()->post('email')->getValue();

    $res = Auth::forgot('auth_users')
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
Auth::forgot('auth_users')
    ->columns('username')
    ->values($email, url('change'))
    # Here the code
    ->timeHash('+2 hours')
    ->register();
```

### Changing email fields

By default, "User" is sent as the name of the sender and recipient. "Reset Password" as the title of the email.

To change these fields, use the `customMailSender()` and/or `customMailFields()` method.

```php
// Custom mail sender
->customMailSender('mail_sender@gmail.com');

// Custom sender, recipient and subject
->customMailFields('name_sender', 'name_recipient', 'subject');
```

The full code is:

```php
Auth::forgot('auth_users')
    ->columns('username')
    ->values($email, url('change'))
    ->customMailSender('mail_sender@gmail.com')
    ->customMailFields('name_sender', 'name_recipient', 'subject')
    ->register();
```

### Changing recovery template email

To change the default email template, you can use Wolf to generate a new template.

You will need to generate a link that will be used to validate the user's password change. To do this, use the `$this->generateRecoveryLink` method, informing as parameters the user's email, the url in which they will change their password and the time that this link will be valid.

```php
$wolf = new Wolf;
$wolf->setArgs([
    'link' => $this->generateRecoveryLink('user_email@gmail.com', url('change'), '+2 hours')
]);
$wolf->setView('auth.template-recovery-password');
$template = $wolf->render();
```

Then add this template to the last parameter of the `customMailFields` method.

```php
Auth::forgot('auth_users')
    ->columns('username')
    ->values($email, url('change'))
    # Here the code
    ->customMailFields('name_sender', 'name_recipient', 'subject', $template)
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

        return view('auth.change-pass-form', [
            'title' => 'Change Password',
            'email' => $email,
            'hash' => $hash
        ]);
    }

    $this->message->new('login', 'The informed link has already expired!');
    response()->redirect(url('auth'));
}
```

## Changing the password

This procedure uses the `change` method to define the database table. The `columns` method defines the database user and password fields. The `values` method defines the user's email in the first parameter, and the new password in the second parameter. The `register` method will check and change the email.

```php
Auth::change('auth_users')
    ->columns('username', 'password')
    ->values($email, $pass)
    ->register();
```

## Password recovery structure

You can create a predefined password recovery framework. To do so, use the `php vinci auth:skeleton --forgot` command.

This command creates a controller with the name `ForgotController`. With it you will have all the basis to create a password recovery system.

If you want to remove this structure, use `php vinci auth:skeleton --forgot --remove`.