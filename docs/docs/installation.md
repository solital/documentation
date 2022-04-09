## Installing via Composer 

To download Solital, use the command below:


```php
composer create-project solital/solital project
```
        
It only takes a few lines of code to get started:

```php
Course::get('/', function() {
    return 'Hello world';
});
```
        
## Running
To execute the project, use the built-in PHP server or create a virtual host:

```php
php -S localhost:8000 -t public/
```