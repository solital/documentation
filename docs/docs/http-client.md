## Introduction

Solital has a component to manipulate the HTTP client, useful for consuming API and making HTTP requests.

## Basic use

To make basic use of the component, you will need use `HttpClient` class. Then, call the function `get`, `post` or other, and the url as a parameter.

```php
use Solital\Core\Http\Client\HttpClient;

$response = HttpClient::get('http://127.0.0.1:8080/api/get')->responseJson();

pre($response);
```

## Supported methods

HttpClient supports the methods below.

```php
HttpClient::get()
HttpClient::post()
HttpClient::put()
HttpClient::delete()
HttpClient::patch()
HttpClient::options()
```

## Return types

You can return the answer in json, array or object. The methods below show an example.

```php
/** Return json */
$client->responseJson();

/** Return array */
$client->responseArray();

/** Return object */
$client->responseObject();
```

If you want to debug the request, use the `enableVerboseOutput()` method.

```php
$response = HttpClient::get('http://127.0.0.1:8080/api/get')->enableVerboseOutput()->responseJson();

pre($response);
```

## Sending data

If you are using a POST or PUT request, for example, and need to send data to the HTTP header, you can pass an array with the values on second parameter.

```php
$data = ['email' => 'solital@email.com'];

$response = HttpClient::post('http://127.0.0.1:8080/api/post', $data)->responseJson();
$response = HttpClient::put('http://127.0.0.1:8080/api/put', $data)->responseJson();
```

## Custom Headers

By default, HttpClient has the following headers:

- Content-Type: application/json
- Accept: application/json

To add other headers to the request, use `setHeaders` method.

```php
$headers = [
    'Content-Type: application/pdf'
];

HttpClient::get('http://127.0.0.1:8080/api/get')->setHeaders($headers)->responseJson();
```

## Disabling SSL verification

HttpClient, by default, use SSL verification. To disable verification, use the `disableSSL()` method.

```php
HttpClient::get('http://127.0.0.1:8080/api/get')->disableSSL()->responseJson();
```

## Authentication

### Basic authentication

If you are handling an API with authentication in basic, you can use the `basicAuth()` method to do the authentication. The first parameter will be the username, while the second parameter will be the password.

```php
HttpClient::get('http://127.0.0.1:8080/api/get')->basicAuth('user', 'pass')->responseJson();
```

### Bearer authentication

For authentications using the bearer token, you can use the `bearerAuth()` method to provide the authentication token.

```php
HttpClient::get('http://127.0.0.1:8080/api/get')
    ->bearerAuth('2edac0d91305c9207d36eda3cbf2c0d7')
    ->responseJson();
```

## Securing your API

When we work with REST API, we need to protect our routes from unauthorized users.

### With JWT token

The most common way to secure an API is through a JWT token. To perform this type of protection, use the `protectRoute()` method of the `JWT` class.

```php
use Solital\Core\Http\Client\JWT;

Course::get('/api/get', function () {

    JWT::protectRoute("your-secret");
    
});
```

To authenticate, you can generate a token using the `encode` method of the `JWT` class and send this token using the `bearerToken()` method.

```php
use Solital\Core\Http\Client\JWT;

$secret = "your-secret";
 
$payload = [
    "sub" => "1234567890",
    "name" => "Brenno",
    "role" => "admin"
];

$token = JWT::encode($payload, $secret);

HttpClient::get('http://127.0.0.1:8080/api/get')->bearerAuth($token)->responseJson();
```

### With Basic Auth

To secure your API using `basic` authentication, use `Guardian` class with `protectBasicAuth()` method providing the username and password to authenticate.

```php
use Solital\Core\Security\Guardian;

Guardian::protectBasicAuth('admin', 'admin');
```

### With Digest Auth

To use `digest` to protect your API, use the `protectDigestAuth()` method. In this method, you must use an array to inform the username and password. You can define multiple users for this authentication type.

```php
use Solital\Core\Security\Guardian;

Guardian::protectDigestAuth(['admin' => 'admin', 'user2' => 'pass2']);
```

### Unauthorize an authenticated user

If you want to deauthorize a user already authenticating (using basic or digest), you can use the `unauthorizeAuth` method.

```php
use Solital\Core\Security\Guardian;

Guardian::unauthorizeAuth();
```

## Asynchronous requests

If you need to make multiple requests, you can use the `sendAsyncRequest()` method. This method makes use of PHP's `curl_multi_init` function. In routes, you will use the `async()` method to mark routes as asynchronous requests.

```php
$response = HttpClient::sendAsyncRequest(function () {

    HttpClient::get('http://127.0.0.1:8080/api/get')->async();
    HttpClient::post('http://127.0.0.1:8080/api/post', ['email' => 'solital@email.com'])->async();
    
})->responseObject();

print_r($response);
```

## Upload and download

You can upload or download a file using the `CurlHandle` class.

```php
# Upload
$url = 'http://127.0.0.1:8080/api/file';

CurlHandle::upload($url, 'data test', 'test.txt');

# Download
$url = 'https://images.pexels.com/photos/...';

CurlHandle::downloader($url, 'photo.jpg');
```