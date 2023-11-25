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
To execute the project, run the command:

```php
php vinci server
```

You can change your project IP if you want

```php
php vinci server localhost:8001
```