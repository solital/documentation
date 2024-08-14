## Introduction

The `.env` file has all the variables that Solital uses. The idea here is that by placing some information in the environment, you are protecting your application (example: access credentials that are not in a text file, protected from accidental copies), and having other less sensitive information in conventional files to facilitate copying and migration.

## Usage

Solital uses the `Dotenv` class to handle all environment variables. All Solital variables are loaded using the `env` method. This method is already configured in the `config.php` file.

But, if you want to check if a variable exists, you can use the `isset()` method.

```php
Dotenv::isset('MY_ENVIRONMENT_VARIABLE');
```

## Environment variables

* Key used for encryption and passwords. Use the `php vinci generate:hash` command to generate a key.

<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">WARNING: When creating a new project, an encrypted key is already generated. Changing the generated key can break your project</h6>
</div>

```bash
APP_HASH=
```

* Displays all errors that Solital or PHP raises. Activate only in development mode

<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">Since Solital Core 4.5.2, this environment no longer used. Use `exceptions.yaml` file instead</h6>
</div>

```bash
ERRORS_DISPLAY=true
```

* Database connection variables. To find out more, see [Katrina ORM](katrina-orm.md)

```bash
DB_DRIVE=
DB_HOST=
DB_NAME=
DB_USER=
DB_PASS=
SQLITE_DIR=
```

* Variables of the Mailer class

```bash
MAIL_DEBUG=
MAIL_HOST=
MAIL_USER=
MAIL_PASS=
MAIL_SECURITY=
MAIL_PORT=
```

* Variables used in encryption. It is recommended that you add new values to these variables.

<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">If you are using the `APP_HASH` variable, then it is not necessary to use the variables below</h6>
</div>

```bash
FIRST_SECRET=first_secret
SECOND_SECRET=second_secret
```

## Checking project status

To check the status of Solita, you can run the `php vinci status` command. This command checks whether there are variables that have not been configured correctly.

## Using other components

If you don't want to use the `Dotenv` class, you can use other libraries like [vlucas/phpdotenv](https://packagist.org/packages/vlucas/phpdotenv).