## Introduction

In some cases, it may be necessary to manipulate javascript's `localstorage` and `sessionstorage` using PHP. You can do this using the `BrowserStorage` class.

## Usage

**Set item**

To store information locally or using a session, you can use one of the methods below:

```php
// localStorage.setItem('$key', $value);
BrowserStorage::local()->setItem($key, $value);

//sessionStorage.setItem('$key', $value);
BrowserStorage::session()->setItem($key, $value);
```

**Get item**

To retrieve the information, use the `getItem()` method.

```php
BrowserStorage::local()->getItem($key);
BrowserStorage::session()->getItem($key);
```

**Remove item**

To remove an item, use the `removeItem()` method.

```php
BrowserStorage::local()->removeItem($key);
BrowserStorage::session()->removeItem($key);
```

**Clear storage**

To clear all storage, use the `clear()` or `clearAll()` method.

```php
BrowserStorage::local()->clear();
BrowserStorage::session()->clear();

// Clears local and session storage
BrowserStorage::clearAll();
```