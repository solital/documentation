## Introduction

“Since 2017, NIST recommends using a secret input when hashing memorized secrets such as passwords. By mixing in a secret input (commonly called a "pepper"), one prevents an attacker from brute-forcing the password hashes altogether, even if they have the hash and salt. For example, an SQL injection typically affects only the database, not files on disk, so a pepper stored in a config file would still be out of reach for the attacker. A pepper must be randomly generated once and can be the same for all users. Many password leaks could have been made completely useless if site owners had done this.

Since there is no pepper parameter for password_hash (even though Argon2 has a "secret" parameter, PHP does not allow to set it), the correct way to mix in a pepper is to use hash_hmac().” [php.net](https://www.php.net/manual/pt_BR/function.password-hash.php#124138)

Solital uses the [SecurePassword](https://github.com/brenno-duarte/php-secure-password) package to validate passwords and prevent attacks. That is, even if someone manages to access the hash created with this package, using only the native `password_verify` function WILL NOT return true.

## Customizing the password

To change the type of algorithm used in encryption, the cost, among other options, you can edit the `auth.yaml` file.

```yaml
password:
  algorithm: default # default - argon2 - argon2d
  pepper: b3f952d5d9adea6f63bee9d4c6fceeaa
  cost: 10
  memory_cost: ''
  time_cost: ''
  threads: ''
```

In the `algorithm` key, you can add the following values: `default `, `argon2` and `argon2d`. For more information about other PHP constants, see [this link](https://www.php.net/manual/pt_BR/password.constants.php).

## Changing the value of "pepper"

As mentioned in the introduction, the `SecurePassword` package uses a `pepper`. To change the value of this `pepper`, you can edit the value of the `peeper` key in the `auth.yaml` file.

**NOTE: Do not change the value of this key too often, as you will need to create a new password each time this value changes. Change only if necessary or if your project is just starting.**