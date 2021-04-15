## Native Mail

Mail is a class of Solital that uses PHP's native mail to send email.

### Use

The sitaxis below is used to be able to send basic e-mail.

```php
use Solital\Core\Resource\Mail\NativeMail;

NativeMail::send("your_sender@email.com", "your_recipient@email.com", 
"your_subject", "your_message");
```
        
### Optional parameters

To add a reply, text type, charset and priority, use the optional parameters.

```php
NativeMail::send("your_sender@email.com", "your_recipient@email.com", "your_subject", 
"your_message", "your_reply@email.com", "type_text", "your_charset", your_priority);
```

Optional parameters have the following values by default:

- Reply to: `(string)` null
- Type: `(string)` text/plan
- Charset: `(string)` UTF-8
- Priority: `(int)` 3

## PHP Mailer

### Use

To use PHP Mailer, edit the variables in `.env` with the information from your email server.

```bash
# PHPMAILER CONFIG
PHPMAILER_DEBUG="0"
PHPMAILER_HOST="mail.yourhost.com"
PHPMAILER_USER="email@your_email.com"
PHPMAILER_PASS="your_password"
PHPMAILER_SECURITY="tls"
PHPMAILER_PORT="587"
```

The code below shows the use of the `PHPMailerClass` class:

```php
use Solital\Core\Resource\Mail\PHPMailerClass;

$mailer = new PHPMailerClass();

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