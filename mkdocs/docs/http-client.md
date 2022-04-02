Solital has a component to manipulate the HTTP client, useful for consuming API and making HTTP requests. Before, you will need to install the component using the command below:

```
composer require solital/http-client
```

## Requirements

- PHP >= 8.0
- CURL extension enabled

## Basic use

To make basic use of the component, you will need to instantiate the `HttpClient` class. Then, call the `request` function, passing the method (GET, POST, ...) and the url as a parameter. Then return the data.

```php
use Solital\HttpClient;

$client = new HttpClient();
$client->request("GET", "http://api.url.com");
$res = $client->toJson();

pre($res);
```

## Supported methods

HttpClient supports the methods below.

- GET
- POST
- PUT
- DELETE
- PATCH
- OPTIONS

## Return types

You can return the answer in json, array or object. The methods below show an example.

```php
$client = new HttpClient();
$client->request("GET", "http://api.url.com");

/** Return json */
$res = $client->toJson();

/** Return array */
$res = $client->toArray();

/** Return object */
$res = $client->toObject();

pre($res);
```

## Sending data

If you are using a POST or PUT request, for example, and need to send data to the HTTP header, you can pass an array with the values in the `request` method.

```php
$client = new HttpClient();

$res = $client->request("PUT", "http://api.url.com", [
    'data' => 'your_data_values'
])->toJson();

echo $res;
```

## Custom Headers

By default, HttpClient has the following headers:

- Content-Type: application/json
- Accept: application/json

To add other headers to the request, use an array in the constructor on the instance.

```php
$headers = [
    'Content-Type: application/pdf'
];

$client = new HttpClient($headers);
#...
```

## Enabling SSL verification

HttpClient by default does not perform SSL verification. To enable verification, use the `enableSSL` method.

```php
$client = new HttpClient();
$client->enableSSL();
#...
```

## Authentication

### Basic Auth

If you are handling an API with authentication in basic, you can use the `basicAuth()` method to do the authentication. The first parameter will be the username, while the second parameter will be the password.

```php
$client = new HttpClient();
$client->basicAuth('user', 'pass');
$client->request("GET", "http://api.url.com");
$res = $client->toJson();

pre($res);
```

### Bearer authentication

For authentications using the bearer token, you can use the `bearerToken()` method to provide the authentication token.

```php
$client = new HttpClient();
$http_client->bearerToken("2edac0d91305c9207d36eda3cbf2c0d7");
$client->request("GET", "http://api.url.com");
$res = $client->toJson();

pre($res);
```

## Securing your API

You can secure your API URL using `basic` or `digest` authentication. First, instantiate the `HttpAuth` class:

```php
use Solital\Http\Auth\HttpAuth;

$auth = new HttpAuth();
```

### With Basic Auth

To secure your API using `basic` authentication, use the `basic()` method providing the username and password to authenticate.

```php
$auth = new HttpAuth();
$auth->basic('username', '123');
```

If you want, you can change the value of `realm` in the second parameter.

```php
$auth = new HttpAuth();
$auth->basic('username', '123', 'my_realm');
```

### With Digest Auth

To use `digest` to protect your API, use the `digest()` method. In this method, you must use an array to inform the username and password. You can define multiple users for this authentication type.

```php
$auth = new HttpAuth();
$auth->digest(['username_1' => 'password_1', 'username_2' => 'password_2', ...]);
```

If you want, you can change the value of `realm` in the second parameter.

```php
$auth = new HttpAuth();
$auth->digest(['username_1' => 'password_1'], 'my_second_realm');
```