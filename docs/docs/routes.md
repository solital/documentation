## Basic routing

Below is a very basic example of setting up a route. First parameter is the url which the route should match - next parameter is a `Closure` or callback function that will be triggered once the route matches.

```php
Course::get('/', function() {
    return 'Hello world';
});
```

You can also create a route using the vinci console:

```bash
php vinci create:router my-router

# With comment
php vinci create:router my-router --comment="This is a comment"
```

### Available methods

Here you can see a list over all available routes:

```php
Course::get($url, $callback, $settings);
Course::post($url, $callback, $settings);
Course::put($url, $callback, $settings);
Course::patch($url, $callback, $settings);
Course::delete($url, $callback, $settings);
Course::options($url, $callback, $settings);
```

### Multiple HTTP-verbs

Sometimes you might need to create a route that accepts multiple HTTP-verbs. If you need to match all HTTP-verbs you can use the `any` method.

```php
Course::match(['get', 'post'], '/', function() {
    // ...
});

Course::any('foo', function() {
    // ...
});
```

We've created a simple method which matches `GET` and `POST` which is most commonly used:

```php
Course::form('foo', function() {
    // ...
});
```

### Default Base Path

This will allows users to set a default basepath for all url requests, which will be prepended to all url parameters.

```php
Course::setDefaultBasepath('/forum')
```

## Route parameters

### Required parameters

You'll properly wondering by know how you parse parameters from your urls. For example, you might want to capture the users id from an url. You can do so by defining route-parameters.

```php
Course::get('/user/{id}', function ($userId) {
    return 'User with id: ' . $userId;
});
```

You may define as many route parameters as required by your route:

```php
Course::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    // ...
});
```

**Note:** Route parameters are always encased within `{}` braces and should consist of alphabetic characters. Route parameters may not contain a `-` character. Use an underscore `_` instead.

### Optional parameters

Occasionally you may need to specify a route parameter, but make the presence of that route parameter optional. You may do so by placing a `?` mark after the parameter name. Make sure to give the route's corresponding variable a default value:

```php
Course::get('/user/{name?}', function ($name = null) {
    return $name;
});

Course::get('/user/{name?}', function ($name = 'Simon') {
    return $name;
});
```

### Regular expression constraints

You may constrain the format of your route parameters using the where method on a route instance. The where method accepts the name of the parameter and a regular expression defining how the parameter should be constrained:

```php
Course::get('/user/{name}', function ($name) {
    
    // ... do stuff
    
})->where('name', '[A-Za-z]+');

Course::get('/user/{id}', function ($id) {
    
    // ... do stuff
    
})->where('id', '[0-9]+');

Course::get('/user/{id}/{name}', function ($id, $name) {
    
    // ... do stuff
    
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
```

### Regular expression route-match

You can define a regular-expression match for the entire route if you wish.

This is useful if you for example are creating a model-box which loads urls from ajax.

The example below is using the following regular expression: `/ajax/([\w]+)/?([0-9]+)?/?` which basically just matches `/ajax/` and exspects the next parameter to be a string - and the next to be a number (but optional).

**Matches:** `/ajax/abc/`, `/ajax/abc/123/`

**Won't match:** `/ajax/`

Match groups specified in the regex will be passed on as parameters:

```php
Course::all('/ajax/abc/123', function($param1, $param2) {
	// param1 = abc
	// param2 = 123
})->setMatch('/\/ajax\/([\w]+)\/?([0-9]+)?\/?/is');
```

### Custom regex for matching parameters

By default Solital uses the `\w` regular expression when matching parameters.
This decision was made with speed and reliability in mind, as this match will match both letters, number and most of the used symbols on the internet.

However, sometimes it can be necessary to add a custom regular expression to match more advanced characters like `-` etc.

Instead of adding a custom regular expression to all your parameters, you can simply add a global regular expression which will be used on all the parameters on the route.

**Note:** If you the regular expression to be available across, we recommend using the global parameter on a group as demonstrated in the examples below.

#### Example

This example will ensure that all parameters use the `[\w\-]+` regular expression when parsing.

```php
Course::get('/path/{parameter}', 'VideoController@home', ['defaultParameterRegex' => '[\w\-]+']);
```

You can also apply this setting to a group if you need multiple routes to use your custom regular expression when parsing parameters.

```php
Course::group(['defaultParameterRegex' => '[\w\-]+'], function() {

    Course::get('/path/{parameter}', 'VideoController@home');

});
```

## Named routes

Named routes allow the convenient generation of URLs or redirects for specific routes. You may specify a name for a route by chaining the name method onto the route definition:

```php
Course::get('/user/profile', function () {
    // Your code here
})->name('profile');
```

You can also specify names for Controller-actions:

```php
Course::get('/user/profile', 'UserController@profile')->name('profile');
```

### Generating URLs To Named Routes

Once you have assigned a name to a given route, you may use the route's name when generating URLs or redirects via the global `url` helper-function (see helpers section):

```php
// Generating URLs...
$url = url('profile');
```

If the named route defines parameters, you may pass the parameters as the second argument to the `url` function. The given parameters will automatically be inserted into the URL in their correct positions:

```php
Course::get('/user/{id}/profile', function ($id) {
    //
})->name('profile');

$url = url('profile', ['id' => 1]);
```

For more information on urls, please see the [Urls](#urls) section.

## Router groups

Route groups allow you to share route attributes, such as middleware or namespaces, across a large number of routes without needing to define those attributes on each individual route. Shared attributes are specified in an array format as the first parameter to the `Course::group` method.

### Namespaces

Solital already has the default namespace to search for controllers (`Solital\Components\Controller`)

#### Note
Group namespaces will only be added to routes with relative callbacks.
For example if your route has an absolute callback like `UserController@home`, the namespace from the route will not be prepended.
To fix this you can make the callback relative by removing the `\` in the beginning of the callback.

```php
Course::group(['namespace' => 'Admin'], function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
});
```

### Subdomain-routing

Route groups may also be used to handle sub-domain routing. Sub-domains may be assigned route parameters just like route urls, allowing you to capture a portion of the sub-domain for usage in your route or controller. The sub-domain may be specified using the `domain` key on the group attribute array:

```php
Course::group(['domain' => '{account}.myapp.com'], function () {
    Course::get('/user/{id}', function ($account, $id) {
        //
    });
});
```

### Route prefixes

The `prefix` group attribute may be used to prefix each route in the group with a given url. For example, you may want to prefix all route urls within the group with `admin`:

```php
Course::group(['prefix' => '/admin'], function () {
    Course::get('/users', function ()    {
        // Matches The "/admin/users" URL
    });
});
```

## Partial groups

Partial router groups has the same benefits as a normal group, but supports parameters and are only rendered once the url has matched.

This can be extremely useful in situations, where you only want special routes to be added, when a certain criteria or logic has been met.

**NOTE:** Use partial groups with caution as routes added within are only rendered and available once the url of the partial-group has matched. This can cause `url()` not to find urls for the routes added within.

**Example:**

```php
Course::partialGroup('/admin/{applicationId}', function ($applicationId) {

    Course::get('/', function($applicationId) {

        // Matches The "/admin/applicationId" URL

    });

});
```

## Custom class loader

You can easily extend simple-router to support custom injection frameworks like php-di by taking advantage of the ability to add your custom class-loader.

Class-loaders must inherit the `ClassLoaderInterface` interface.

**Example:**

```php
class MyCustomClassLoader implements ClassLoaderInterface
{
    /**
     * Load class
     *
     * @param string $class
     * @return object
     * @throws NotFoundHttpException
     */
    public function loadClass(string $class)
    {
        if (\class_exists($class) === false) {
            throw new NotFoundHttpException(sprintf('Class "%s" does not exist', $class), 404);
        }

        return new $class();
    }

    /**
     * Load closure
     *
     * @param Callable $closure
     * @param array $parameters
     * @return mixed
     */
    public function loadClosure(Callable $closure, array $parameters)
    {
        return \call_user_func_array($closure, array_values($parameters));
    }

}
```

Next, we need to configure our `routes.php` so the router uses our `MyCustomClassLoader` class for loading classes. This can be done by adding the following line to your `routes.php` file.

```php
Course::setCustomClassLoader(new MyCustomClassLoader());
```

## Exception Handlers

ExceptionHandler are classes that handles all exceptions. ExceptionsHandlers must implement the `ExceptionHandlerInterface` interface.

### Handling 404, 403 and other errors

If you simply want to catch a 404 (page not found) etc. you can use the `Course::error($callback)` static helper method.

This will add a callback method which is fired whenever an error occurs on all routes.

The basic example below simply redirect the page to `/not-found` if an `NotFoundHttpException` (404) occurred.
The code should be placed in the file that contains your routes.

```php
Course::get('/not-found', 'PageController@notFound');
Course::get('/forbidden', 'PageController@notFound');

Course::error(function(Request $request, \Exception $exception) {
    switch($exception->getCode()) {
        // Page not found
        case 404:
            response()->redirect('/not-found');
        // Forbidden
        case 403:
            response()->redirect('/forbidden');
    }
});
```

The example above will redirect all errors with http-code `404` (page not found) to `/not-found` and `403` (forbidden) to `/forbidden`.

If you do not want a redirect, but want the error-page rendered on the current-url, you can tell the router to execute a rewrite callback like so:

```php
$request->setRewriteCallback('ErrorController@notFound');
```

If you will set the correct status for the browser error use:

```php
Course::response()->httpCode(404);
```

### Using custom exception handlers

This is a basic example of an ExceptionHandler implementation.

```php
use Solital\Core\Http\Request;
use Solital\Core\Http\Exception\NotFoundHttpException;
use Solital\Core\Exceptions\ExceptionHandlerInterface;

class CustomExceptionHandler implements ExceptionHandlerInterface
{
	public function handleError(Request $request, \Exception $error): void
	{
		/* You can use the exception handler to format errors depending on the request and type. */

		if ($request->getUrl()->contains('/api')) {
			response()->json([
				'error' => $error->getMessage(),
				'code'  => $error->getCode(),
			]);

		}

		/* The router will throw the NotFoundHttpException on 404 */
		if($error instanceof NotFoundHttpException) {
			// Render custom 404-page
			$request->setRewriteCallback('Demo\Controllers\PageController@notFound');
			return;		
		}
		
		/* Other error */
		if($error instanceof MyCustomException) {
			$request->setRewriteRoute(
				/* Add new route based on current url (minus query-string) and add custom parameters. */
				(new RouteUrl(url(null, null, []), 'PageController@error'))
                    ->setParameters(['exception' => $error])
			);
			return;	
		}

		throw $error;
	}
}
```

You can add your custom exception-handler class to your group by using the `exceptionHandler` settings-attribute.
`exceptionHandler` can be either class-name or array of class-names.

```php
Course::group(['exceptionHandler' => CustomExceptionHandler::class], function() {
    // Your routes here
});
```

### Prevent merge of parent exception-handlers

By default the router will merge exception-handlers to any handlers provided by parent groups, and will be executed in the order of newest to oldest.

If you want your groups exception handler to be executed independently, you can add the `mergeExceptionHandlers` attribute and set it to `false`.

```php
Course::group([
    'prefix' => '/', 
    'exceptionHandler' => FirstExceptionHandler::class, 
    'mergeExceptionHandlers' => false
], function() {

	Course::group(['prefix' => '/admin', 'exceptionHandler' => SecondExceptionHandler::class], function() {
		// Both SecondExceptionHandler and FirstExceptionHandler will trigger (in that order).
	});
	
	Course::group([
        'prefix' => '/user', 
        'exceptionHandler' => SecondExceptionHandler::class, 
        'mergeExceptionHandlers' => false
    ], function() {
		// Only SecondExceptionHandler will trigger.
	});
});
```

## URL Rewriting

### Changing current route

Sometimes it can be useful to manipulate the route about to be loaded.
Solital allows you to easily manipulate and change the routes which are about to be rendered.
All information about the current route is stored in the `\Solital\Core\Course\Router` instance's `loadedRoute` property.

For easy access you can use the shortcut helper function `request()` instead of calling the class directly `\Solital\Core\Course\Course::router()`.


```php
request()->setRewriteCallback('Example\MyCustomClass@hello');

// -- or you can rewrite by url --

request()->setRewriteUrl('/my-rewrite-url');
```

### Bootmanager: loading routes dynamically

Sometimes it can be necessary to keep urls stored in the database, file or similar. In this example, we want the url ```/my-cat-is-beatiful``` to load the route ```/article/view/1``` which the router knows, because it's defined in the ```routes.php``` file.

To interfere with the router, we create a class that implements the ```RouterBootManagerInterface``` interface. This class will be loaded before any other rules in ```routes.php``` and allow us to "change" the current route, if any of our criteria are fulfilled (like coming from the url ```/my-cat-is-beatiful```).

To create a bootmanager, run the command:

```bash
php vinci create:boot CustomRouterRules
```

All bootmanagers you create will be stored in the `app/BootManager/` folder.

```php
<?php

namespace Solital\BootManager;

use Solital\Core\Http\Request;
use Solital\Core\Course\RouterBootManagerInterface;
use Solital\Core\Course\Router;

class CustomRouterRules implements RouterBootManagerInterface 
{
    /**
     * Called when router is booting and before the routes is loaded.
     *
     * @param Router $router
     * @param Request $request
     */
    public function boot(Router $router, Request $request): void
    {
        $rewriteRules = [
            '/my-cat-is-beatiful' => '/article/view/1',
            '/horses-are-great'   => '/article/view/2',
        ];

        foreach ($rewriteRules as $url => $rule) {
            // If the current url matches the rewrite url, we use our custom route

            if ($request->getUri()->getPath() === $url) {
                $request->setRewriteUrl($rule);
            }
        }
    }
}
```

The above should be pretty self-explanatory and can easily be changed to loop through urls store in the database, file or cache.

What happens is that if the current route matches the route defined in the index of our ```$rewriteRules``` array, we set the route to the array value instead.

By doing this the route will now load the url ```/article/view/1``` instead of ```/my-cat-is-beatiful```.

### Adding routes manually

The ```Course``` class referenced in the previous example, is just a simple helper class that knows how to communicate with the ```Router``` class.
If you are up for a challenge, want the full control or simply just want to create your own ```Router``` helper class, this example is for you.

```php
use \Solital\Core\Course\Router;
use \Solital\Core\Course\Route\RouteUrl;

/* Create new Router instance */
$router = new Router();

$route = new RouteUrl('/answer/1', function() {

    die('this callback will match /answer/1');

});

$route->addMiddleware(\Demo\Middlewares\AuthMiddleware::class);
$route->setNamespace('\Demo\Controllers');
$route->setPrefix('v1');

/* Add the route to the router */
$router->addRoute($route);
```

## Extending

This is a simple example of an integration into a framework.

The framework has it's own ```Router``` class which inherits from the ```Course``` class. This allows the framework to add custom functionality like loading a custom `routes.php` file or add debugging information etc.

```php
namespace Demo;

use Solital\Core\Course\Course;

class Router extends Course {

    public static function start() {

        // change default namespace for all routes
        parent::setDefaultNamespace('\Demo\Controllers');

        // change this to whatever makes sense in your project
        require_once 'routes.php';

        // Do initial stuff
        parent::start();

    }
}
```

## Form Method Spoofing

HTML forms do not support `PUT`,` PATCH` or `DELETE` actions. Therefore, when defining the `PUT`,` PATCH` or `DELETE` routes that are called from an HTML form, you will need to use the `spoofing` helper to add a hidden `_method` field to the form. The value sent with the `_method` field will be used as the HTTP request method:

```php
<form method="post" action="{{ url() }}">
    {{ spoofing('put'); }}
    <!-- other input elements here -->
</form>
```

## Accessing The Current Route

You can access information about the current route loaded by using the following method:

```php
Course::request()->getLoadedRoute();
request()->getLoadedRoute();
```

## Other examples

You can find many other examples in the sample file below:

```php
<?php
use Solital\Core\Course\Course;

/* Adding custom csrfVerifier here */
Course::csrfVerifier(new \Demo\Middlewares\CsrfVerifier());

Course::group([
    'middleware' => \Demo\Middlewares\Site::class, 
    'exceptionHandler' => \Demo\Handlers\CustomExceptionHandler::class
], function() {

    Course::get('/answers/{id}', 'ControllerAnswers@show', ['where' => ['id' => '[0-9]+']]);

    /**
     * Restful resource (see IRestController interface for available methods)
     */
    Course::resource('/rest', ControllerRessource::class);

    /**
     * Load the entire controller (where url matches method names - getIndex(), postIndex(), putIndex()).
     * The url paths will determine which method to render.
     *
     * For example:
     *
     * GET  /animals         => getIndex()
     * GET  /animals/view    => getView()
     * POST /animals/save    => postSave()
     *
     * etc.
     */
    Course::controller('/animals', ControllerAnimals::class);
});

Course::get('/page/404', 'ControllerPage@notFound', ['as' => 'page.notfound']);

```