## Encrypt

To create an encrypted key, use the `Hash` class together with the static `encrypt` function as shown below:

```php
use Solital\Core\Security\Hash;

$res = Hash::encrypt('word_to_encrypt');

pre($res);
```

You can define how long this key will be valid. It can be 1 second, 1 hour or 1 year. by default the value is `+1 hour`.

```php
use Solital\Core\Security\Hash;

$res = Hash::encrypt('word_to_encrypt', '+1 month');

pre($res);
```

## Decrypt

If you want to decrypt, use the `decrypt` function chained with the `value` method.

```php
use Solital\Core\Security\Hash;

$res = Hash::decrypt('word_to_decrypt')->value();

pre($res);
```

## Check value

If you want to check if the encrypted key is still valid, use `isValid`. If you want to verify that the encrypted key is still valid, use `isValid`. the `isValid` method will return` true` if it is still valid, and `false` if it is already expired

```php
use Solital\Core\Security\Hash;

$res = Hash::decrypt('word_to_decrypt')->isValid();

pre($res);
```