Mailer is Solital's default class for sending emails. The Mailer class uses the `PHPMailer` component to send emails. In addition, you can create email queues asynchronously, and also use another email account to test your project.

To use this component, first edit the `.env` file.

```bash
MAIL_DEBUG="0"
MAIL_HOST="mail.yourhost.com"
MAIL_USER="email@your_email.com"
MAIL_PASS="your_password"
MAIL_SECURITY="tls"
MAIL_PORT="587"
```

The code below shows the use of the `Mailer` class:

```php
use Solital\Core\Resource\Mail\Mailer;

$mailer = new Mailer();

// Add sender and recipient information 
$mailer->add('sender_email@gmail.com', 'Sender name', 'recipient_email@gmail.com', 'Recipient name');

// Send a file by email (OPTIONAL) 
$mailer->attach('image.png', 'image_name');

// Send an image in HTML (OPTIONAL) 
$mailer->embeddedImage('image.png', 'image', 'image');

// Send email 
$mailer->send('E-mail test', '<h1>E-mail test</h1><p>cid:image</p>');

// If there is an error 
if ($mailer->error()) {
    echo $mailer->error();
}
```

## E-mail queues

To create an email queue, first check your database is connected. All emails will be saved in a database to be sent later. The process is similar to sending a standard email, the difference is the use of the `queue()` method.

```php
// Add sender and recipient information 
$mailer->add('sender_email@gmail.com', 'Sender name', 'recipient_email@gmail.com', 'Recipient name');

// Send email 
$mailer->queue('E-mail test', '<h1>E-mail test</h1>');
```

After the emails are saved in the database, use the `sendQueue()` method to send all the emails. You can set a delay in seconds for sending the emails (default is 5 seconds).

```php
$mailer = new Mailer();
$mailer->sendQueue();

// Delay 10 seconds
$mailer->sendQueue(10);
```

## Test email

If you want to perform tests using another email, you can change the settings using the `mail.yaml` file. When enabling this option, Solital will use the settings from the `mail.yaml` file instead of the settings from the `.env` file.

Enable email testing by changing the `mail_test_enable` variable to `true` and changing the settings in this file. To enable exceptions when there is an error when sending the email, change the `mail_exceptions` variable to `true`.

```yaml
# Enable exception in Mailer class
# Values: true, false
mail_exceptions: true

# Enable mail test in localhost
mail_test:
  mail_test_enable: false
  mail_debug: 0
  mail_host: 
  mail_user: 
  mail_pass: 
  mail_security: tls
  mail_port: 587
```