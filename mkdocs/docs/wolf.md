Wolf is Solital's standard template system. You can load any template into the `resource/views` folder

## Basic

Below is the basic code to load any template:

```php
use Solital\Core\Wolf\Wolf;

Wolf::loadView('home');
```
        
## Parameters

The sitaxe below loads the parameters to be viewed in your template.

```php
Wolf::loadView('home', [
    'title' => 'My Title'
]);
```
        
And in your `home.php`, retrieve the value informed in this way:

```html
<title>$title</title>
```
        
## Custom extensions

Wolf will search for files in `php` format, but to search for a different format, use the last parameter.

```php
Wolf::loadView('home', [
    'title' => 'My Title'
], "html");
```
        
## Loading CSS, JS and images

Make sure the files exist in the folder `public/assets/_css`, `public/assets/_js` and `public/assets/_img`

To load a CSS file, use the static `loadCss` method in your template.

```html
<link rel="stylesheet" href="<?= loadCss('style.css'); ?>">
```
        
To load a JS file, use the static `loadJs` method in your template.

```html
<link rel="stylesheet" href="<?= loadJs('file.js'); ?>">
```
        
To load a image file, use the static `loadImg` method in your template.

```html
<img src="<?= loadImg('image.png'); ?>">
```

To load a file outside the `_css`,` _js` and `_img` folder, use the `loadFile` method.

```html
<img src="<?= loadFile('path/for/your/file'); ?>">
```

## Cache templates

If you have a template that takes a long time to load, or is rarely accessed, consider creating a cache of that template.

Wolf's cache works as follows: a page is loaded, then a page identical to the one that was loaded with all the data already saved in cache is created. When reloading, if this page is still valid, the page's cache will be displayed.

The syntax below shows how long the template can be cached.

```php
# The template is cached for one minute
Wolf::cache()->forOneMinute();

# The template is cached for an hour
Wolf::cache()->forOneHour();

# The template is cached for a day
Wolf::cache()->forOneDay();

# The template is cached for a week
Wolf::cache()->forOneWeek();

Wolf::loadView('home', [
    'title' => 'My Title'
]);
```

To create the cache for all templates, consider using this method in the controller constructor.

```php
<?php

namespace Solital\Components\Controller;

use Solital\Components\Controller\Controller;

class UserController extends Controller 
{
    /**
    * Construct
    */
    public function __construct()
    {
        Wolf::cache()->forOneHour();
    } 

    /**
    * @return void
    */
    public function home(): void
    {
        Wolf::loadView('home', [
            'title' => 'My Title'
        ]);
    }

    ## Other methods...
}
```

## Minify Assets

Having to load multiple CSS and Javascript files can be a lot of work and can be a burden on the site. However, you can minify all of these files into a single CSS and JS file.

By default, assets are loaded into the `public/assets/` folder. However, there is a second assets folder inside specific `resource/` to minify the CSS/JS files.

When placing files inside `resources/assets/`, you can call the `minify` method. The code below shows the correct use of this method:

```php
# Minify only CSS files
Wolf::minify()->style();

# Minify only Javascript files
Wolf::minify()->script();

# Minify CSS and Javascript files
Wolf::minify()->all();
```

### Load minified files into the template

The `loadMinCss()` and `loadMinJs()` functions will load all files that are minified, without having to use the `loadCss()` and `loadJs()` functions.

```php
# Load minify CSS
<link rel="stylesheet" href="<?= loadMinCss() ?>">

# Load minify JS
<script src="<?= loadMinJs() ?>"><script>
```