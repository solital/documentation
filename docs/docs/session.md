## Managing Sessions

Using the `Session` class, you can start and resume sessions in a way that is compatible to PHP’s built-in `session_start()` function, while having access to the improved cookie handling from this library as well:

```php
use Solital\Core\Resource\Session;

// start session and have session cookie with 'lax' same-site restriction
Session::start();
// or
Session::start('Lax');

// start session and have session cookie with 'strict' same-site restriction
Session::start('Strict');

// start session and have session cookie without any same-site restriction
Session::start(null);
// or
Session::start('None'); // Chrome 80+
```

All three calls respect the settings from PHP’s `session_set_cookie_params(...)` function and the configuration options `session.name`, `session.cookie_lifetime`, `session.cookie_path`, `session.cookie_domain`, `session.cookie_secure`, `session.cookie_httponly` and `session.use_cookies`.

Likewise, replacements for

```php
session_regenerate_id();
// and
session_regenerate_id(true);
```

are available via

```php
Session::regenerate();
// and
Session::regenerate(true);
```

if you want protection against session fixation attacks that comes with improved cookie handling.

Additionally, access to the current internal session ID is provided via

```php
Session::id();
```

as a replacement for

```php
session_id();
```

## Reading and writing session data

* Read a value from the session (with optional default value):

```php
$value = Session::get($key);

# With helper
$value = session($key);

// or
$value = Session::get($key, $defaultValue);

# With helper
$value = session($key, defaultValue: 'default_value');
```

* Write a value to the session:

```php
Session::set($key, $value);

# With helper
session($key, $value);
```

* Check whether a value exists in the session:

```php
if (Session::has($key)) {
    // ...
}
```

* Remove a value from the session:

```php
Session::delete($key);

# With helper
session($key, delete: true);
```

* Read *and then* immediately remove a value from the session:

```php
$value = Session::take($key);
$value = Session::take($key, $defaultValue);

# With helper
$value = session($key, take: true);
```

This is often useful for flash messages, e.g. in combination with the `has(...)` method.

## Advanced

<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">Available in Core 4.6.0</h6>
</div>

### Changing default session options

You can change some default session options using the `session.yaml` file.

```yaml
# Set the current session name
name: 

# Sets user-level session storage (files, sqlite, memcached, encrypt, pdo, apcu, dump)
save_handler: files

# Set the current session save path for memcached and redis
save_path: localhost:11211

# Specifies whether the module will use strict session id mode
strict_mode: false

# Set the current cache limiter
cache_limiter: public

# Set current cache expire
cache_expire: 30

# Specifies the number of seconds after which data will be seen as 'garbage' 
# and potentially cleaned up. Default is 1440
gc_max_lifetime: 1440

# setGcProbability() in conjunction with session.gc_divisor is used to manage 
# probability that the gc (garbage collection) routine is started. Defaults to 1
gc_probability: 1

# session.gc_divisor coupled with session.gc_probability defines the probability 
# that the gc (garbage collection) process is started on every session initialization.
gc_divisor: 100
```

### Change default handler

You can change the default session handler using `save_handler` option. The available handlers are:

- `files:` default handler
- `sqlite:` saves the session using SQLite
- `memcached:` saves the session on the Memcached server. You can change the default path using the `save_path` option
- `encrypt:` same as the `files` option, but saves the session in encrypted form
- `pdo:` saves the session in the database using the `.env` file
- `apcu:` saves the session using APCu
- `dump:` dumps the session