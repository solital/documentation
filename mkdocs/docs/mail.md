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
$mailer->sendEmail('E-mail test', '<h1>E-mail test</h1><p>cid:image</p>');

// If there is an error 
if ($mailer->error()) {
    echo $mailer->error();
}
```