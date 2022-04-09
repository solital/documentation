By default all controller and resource routes will use a simplified version of their url as name.

You easily use the `url()` shortcut helper function to retrieve urls for your routes or manipulate the current url.

`url()` will return a `Uri` object which will return a `string` when rendered, so it can be used safely in templates etc. but 
contains all the useful helpers methods in the `Uri` class like `contains`, `indexOf` etc. 
Check the [Useful url tricks](#useful-url-tricks) below.

### Get the current url

It has never been easier to get and/or manipulate the current url.

The example below shows you how to get the current url:

```php
# output: /current-url
url();
```

### Get by name (single route)

```php
Course::get('/product-view/{id}', 'ProductsController@show', ['as' => 'product']);

# output: /product-view/22/?category=shoes
url('product', ['id' => 22], ['category' => 'shoes']);

# output: /product-view/?category=shoes
url('product', null, ['category' => 'shoes']);
```

### Get by name (controller route)

```php
Course::controller('/images', ImagesController::class, ['as' => 'picture']);

# output: /images/view/?category=shows
url('picture@getView', null, ['category' => 'shoes']);

# output: /images/view/?category=shows
url('picture', 'getView', ['category' => 'shoes']);

# output: /images/view/
url('picture', 'view');
```

### Get by class

```php
Course::get('/product-view/{id}', 'ProductsController@show', ['as' => 'product']);
Course::controller('/images', 'ImagesController');

# output: /product-view/22/?category=shoes
url('ProductsController@show', ['id' => 22], ['category' => 'shoes']);

# output: /images/image/?id=22
url('ImagesController@getImage', null, ['id' => 22]);
```

### Using custom names for methods on a controller/resource route

```php
Course::controller('gadgets', GadgetsController::class, ['names' => ['getIphoneInfo' => 'iphone']]);

url('gadgets.iphone');

# output
# /gadgets/iphoneinfo/
```

### Getting REST/resource controller urls

```php
Course::resource('/phones', PhonesController::class);

# output: /phones/
url('phones');

# output: /phones/
url('phones.index');

# output: /phones/create/
url('phones.create');

# output: /phones/edit/
url('phones.edit');
```

### Manipulating url

You can easily manipulate the query-strings, by adding your get param arguments.

```php
# output: /current-url?q=cars

url(null, null, ['q' => 'cars']);
```

You can remove a query-string parameter by setting the value to `null`. 

The example below will remove any query-string parameter named `q` from the url but keep all others query-string parameters:

```php
$url = url()->removeParam('q');
```

### Useful url tricks

Calling `url` will always return a `Url` object. Upon rendered it will return a `string` of the relative `url`, so it's safe to use in templates etc.

However this allow us to use the useful methods on the `Url` object like `indexOf` and `contains` or retrieve specific parts of the url like the path, querystring parameters, host etc. You can also manipulate the url like removing- or adding parameters, changing host and more.

In the example below, we check if the current url contains the `/api` part.

```php
if(url()->contains('/api')) {
    // ... do stuff
}
```

As mentioned earlier, you can also use the `Uri` object to show specific parts of the url or control what part of the url you want.

```php
# Grab the query-string parameter id from the current-url.
$id = url()->getParam('id');

# Get the absolute url for the current url.
$absoluteUrl = url()->getAbsoluteUrl();
```

For more available methods please check the `Uri` class.