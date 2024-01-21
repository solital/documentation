Wolf is Solital's default template engine. With Wolf, you can display any HTML, CSS and JavaScript code. Wolf has the following features: generate views cache; extend other views; minify CSS and JS files; use native HTML files. You can load any template into the `resource/views` folder

## Basic

To use the Wolf Template, you can use the `view()` helper, or create an instance of the `Wolf` class.

```php
use Solital\Core\Wolf\Wolf;

// With helper
Course::get('/', function () {
    return view('welcome');
});

// With instance
Course::get('/', function () {
    $wolf = new Wolf();
    $wolf->setView('welcome');

    return $wolf->render();
});
```

## Markers in Wolf

Wolf uses markers to interpret PHP code within views. That is, when using `{{ }}`, Wolf will interpret these characters as `<?= ?>`. Likewise, when using `{% %}`, Wolf will interpret it as `<?php ?>`.

That way, you can use native PHP code inside your views using the bookmarks.
        
## Parameters

To display data for your view, use the second parameter of the `view` helper or `loadView` method.

```php
// With helper
Course::get('/', function () {
    return view('welcome', [
        'title' => 'My Title'
    ]);
});

// With instance
Course::get('/', function () {
    $wolf = new Wolf();
    $wolf->setArgs([
        'title' => 'My Title'
    ]);
    $wolf->setView('welcome');

    return $wolf->render();
});
```
        
And in your `home.php`, retrieve the value informed in this way:

```html
<title>{{ title }}</title>
```
        
## Loading CSS, JS and images

Make sure the files exist in the folder `public/assets/_css`, `public/assets/_js` and `public/assets/_img`

To load a CSS file, use the static `load_css` method in your template.

```html
<link rel="stylesheet" href="{{ load_css('style.css'); }}">
```
        
To load a JS file, use the static `load_js` method in your template.

```html
<link rel="stylesheet" href="{{ load_js('file.js'); }}">
```
        
To load a image file, use the static `load_img` method in your template.

```html
<img src="{{ load_img('image.png'); }}">
```

To load a file outside the `_css`,` _js` and `_img` folder, use the `load_file` method.

```html
<img src="{{ load_file('path/for/your/file'); }}">
```

## Cache templates

**Cache on all pages**

If you have a template that takes a long time to load, or is rarely accessed, consider creating a cache of that template.

Wolf's cache works as follows: a page is loaded, then a page identical to the one that was loaded with all the data already saved in cache is created. When reloading, if this page is still valid, the page's cache will be displayed.

To cache your views, edit the `bootstrap.yaml` file:

```yaml
wolf_cache:
  enabled: true # false
  time: minute  # minute, hour, day, week
```

In `time`, you can define if you want to cache your views for 1 minute, 1 hour, 1 day or 1 week.

**Cache on a single page**

If you don't want to create a cache file for all templates, consider using the `setCacheTime` method before `setView` method to generate a cache file for each template. This class will create a cache file just for a single view (or for several if you add this class in the Controller's constructor).

The syntax below shows how long the template can be cached.

```php
// minute - hour - day - week
$wolf->setCacheTime('week');
```

## Minify Assets

Having to load multiple CSS and Javascript files can be a lot of work and can be a burden on the site. However, you can minify all of these files into a single CSS and JS file.

By default, assets are loaded into the `public/assets/` folder. However, there is a second assets folder inside specific `resource/` to minify the CSS/JS files.

If you want to generate a minified file for your assets, first add your CSS and JavaScript files to the `resource/assets` folder. Then edit the `bootstrap.yaml` file.

```yaml
wolf_minify: false
```


|   |
|-----|
|`style`: minify only CSS files|
|`script`: minify only JS files|
|`all`: minify CSS and JS files|
|`false`: don't minify files|

### Load minified files into the template

The `load_min_css()` and `load_min_js()` functions will load all files that are minified, without having to use the `load_css()` and `load_js()` functions.

```php
# Load minify CSS
<link rel="stylesheet" href="{{ load_min_css() }}">

# Load minify JS
<script src="{{ load_min_js() }}"><script>
```

## Extending templates

It is very common for developers to create a `header.php` file and include it in other files. With Wolf this is also possible using the `extend` method.

The `extend` method includes any template that is inside the `resource/view` folder.

```html
{% extend('header') %}
```

It is not necessary to inform the file extension, just use the file home without the extension.

### View inside a folder

If you want to extend a view inside a folder, use a (.) separator.

```html
{% extend('auth.header') %}
```

## Conditionals

### Production and development mode

If you want a code to be displayed only in production mode or only in development mode, you can use the `production` and `development` methods.

```html
{% production %}
<!-- This code will only be displayed in production mode -->
{% endproduction %}

{% development %}
<!-- This code will only be displayed in development mode -->
{% enddevelopment %}
```

### Conditional if true

If there is a variable or element that you want to display if another element is true, use the `conditional` helper.

```html
{% $is_error = true; %}

<span class="{{ conditional('text-danger', $is_error) }}">DANGER!!!</span>

<!-- <span class="text-danger">DANGER!!!</span> -->
```