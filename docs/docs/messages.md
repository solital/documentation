Message is a component for displaying flash alerts in views rendered with Wolf Template. With it, it is possible to display a message of success, error or any other type of message. By default, this class is already instantiated in the `Controller` class.

**NOTE:** if you do not extend the `Controller` class, you will need to instantiate the `Message` class.

```php
use Solital\Core\Resource\Message;

$message = new Message();
```

## How to use

You can create a normal message using the `messages()` helper. First, you must add an index to your message in the first parameter. This index serves to identify your message. In the second parameter, you will add your message.

This will create a clean message without customizations (see more in [Customizing messages](#customizing-messages)).

```php
message('msg.test', 'Just a test message displayed in the view!');
```

### Using in Controllers

If you are on a Controller. You have the option of not using the previous helper, as the `Message` class is already instantiated by default. To do this, use `new()` method.

```php
$this->message->new('msg.test', 'Just a test message displayed in the view!');
```

### Returning messages

To retrieve this message, use the `get()` method. 

```php
/** With method in Controller */
echo $this->message->get('msg.test');

/** With helper */
echo message()->get('msg.test');
```

## Customizing messages

As mentioned at the beginning, the Message class has customized message options: info, success, warning and error.

```php
message()->info('msg.info.test', 'Info message test');
message()->success('msg.success.test', 'Success message test');
message()->warning('msg.warning.test', 'Warning message test');
message()->error('msg.error.test', 'Error message test');
```

Using one of the previous methods, you will get messages similar to these:

```html
<div class="alert-info">Info message test</div>
<div class="alert-success">Success message test</div>
<div class="alert-warning">Warning message test</div>
<div class="alert-error">Error message test</div>
```

### Checking if a message exists

If you want to know if a message exists, you can use the `has()` method.

```php
message()->has('msg.test');
```

This way you will check if a simple message exists. However, if you want to know if a custom message exists, you can use the following constants:

```php
message()->has('msg.info.test', Message::INFO);
message()->has('msg.success.test', Message::SUCCESS);
message()->has('msg.warning.test', Message::WARNING);
message()->has('msg.error.test', Message::ERROR);
```

Alternatively, if you want to know if there are only error messages, you can use the `hasErrors()` method.

```php
message()->hasErrors();
```

## Using in Wolf Template

To make use of this component in Wolf, the method of creating the message is exactly the same. The code represents a practical and recommended method of retrieving the message. 

```php
<?php

namespace Solital\Components\Controller;

use Solital\Core\Http\Controller\Controller;

class UserController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        parent::_construct();
    }

    /**
     * @return void
     */
    public function home(): void
    {
        return view('home', [
            'msg' => message()->get('msg.test') // or use: $this->message->get('msg.test')
        ]);
    }

    /**
     * @return void
     */
    public function generate(): void
    {
        message('msg.test', 'Just a test message displayed in the view!');

        // Or use: $this->message->new('msg.test', 'Just a test message displayed in the view!');
    }
    
```

In your view, display the message this way:

```html
<div>

{% if ($msg): %}
    <p>{{ $msg }}</p>
{% endif; %}

</div>
```