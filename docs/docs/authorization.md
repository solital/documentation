## Introduction

When we log in to a more complex system, this system generally has authorization levels for each user, that is, we have to ensure that only authenticated users can access specific pages.

Solital has an authentication system to protect your user pages from other database tables.

## How to use

You must use the `Guardian` class to authorize the pages. You can authorize using a specific database table or using a specific email.

### Authorize users of a database table

For example, if you have a table in the database called `tb_admin` and you want only users who have been saved in that table to be allowed to access a specific page, you would use the `allowFromTable` method.

```php
Guardian::allowFromTable('tb_admin');
```

If you have users saved in another table (for example: `tb_users`), these users will be redirected to the login page. When redirected, a message will be displayed to the unauthorized user. You can customize this message.

```php
Guardian::allowFromTable('tb_admin', 'No permission');
```

### Deny users of a database table

Alternatively, if you want users of a database table to not access a specific page, you can use the `denyFromTable()` method.

```php
Guardian::denyFromTable('tb_users');

// With a custom message
Guardian::denyFromTable('tb_users', 'No permission');
```

### Authorize or deny a specific user

In some cases, you may want only a single specific user to be allowed to access a page rather than allowing multiple users of a database table. For these cases, you can use the `allowUser()` method.

```php
Guardian::allowUser('solital@email.com');

// With a custom message
Guardian::allowUser('solital@email.com', 'No permission');
```

Alternatively, you can deny a single specific user instead of denying the entire database table.

```php
Guardian::denyUser('solital@email.com');

// With a custom message
Guardian::denyUser('solital@email.com', 'No permission');
```