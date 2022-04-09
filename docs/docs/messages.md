Message is a component for displaying alerts in views rendered with Wolf Template. With it, it is possible to display a message of success, error or any other type of message. By default, this class is already instantiated in the `Controller` class.

**NOTE:** if you do not extend the `Controller` class, you will need to instantiate the `Message` class.

```php
use Solital\Core\Resource\Message;

$message = new Message();
```

## How to use

You can create a message using the `new()` method in controller, or using the `messages()` helper:

```php
/** With method */
$this->message->new('msg.test', 'Just a test message displayed in the view!');

/** With helper */
message('msg.test', 'Just a test message displayed in the view!');
```

To retrieve this message, use the `get` method. 

```php
/** With method */
echo $this->message->get('msg.test');

/** With helper */
echo message('msg.test');
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
            'msg' => $this->message->get('msg.test') // message('msg.test');
        ]);
    }

    /**
     * @return void
     */
    public function generate(): void
    {
        $this->message->new('msg.test', 'Just a test message displayed in the view!');

        // message('msg.test', 'Just a test message displayed in the view!');
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