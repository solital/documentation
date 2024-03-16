## Introduction

Solital makes use of OpenSSL and Sodium encryption. If you are using Core >= 4.2, you should find the following variables in your `.env` file: `APP_HASH`, `FIRST_SECRET` and `SECOND_SECRET`. The `APP_HASH` variable is the main variable used by Solital, but if this variable is not available, the other two can be used instead.

**NOTE: For the variables `FIRST_SECRET` and `SECOND_SECRET`, use encrypted characters. If the variable `APP_HASH` is empty, run the command `php vinci generate:hash`**

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

## Sodium encryption

Solital supports Sodium encryption. To enable, make sure that libsodium is installed in your development environment. You can use the `Hash::checkSodium()` method to check if libsodium is installed.

### Generating a sodium key

First, you need to generate a sodium key. This key is automatically renewed with each new request, so it can be stored in a database, in the session or in another type of storage.

```php
use Solital\Core\Security\Hash;

$key = Hash::getSodiumKey();
```

### Encrypting and decrypting with Sodium

Use the `Hash::sodiumCrypt()` (to encrypt), and `Hash::sodiumDecrypt()` (to decrypt) methods. Remember to use the key generated using the `Hash::getSodiumKey()` method.

```php
use Solital\Core\Security\Hash;

$key = Hash::getSodiumKey();

# Crypt
$encoded = Hash::sodiumCrypt("HashTest!", $key);
pre($encoded);

# Decrypt
$decoded = Hash::sodiumDecrypt($encoded, $key);
pre($decoded);
```

