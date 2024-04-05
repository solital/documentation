Solital has the `Number` class to manipulate numbers. You can use one of the methods below:

```php
use Solital\Core\Resource\Number;

// Reduce a number
Number::reduce(1.2335566);

// Format a number to currency
Number::currency(12345678.90, 'BRL');

// Format a numer to percentage
Number::percent(0.123);

// Spellout rule-based format
Number::spell(12345678);

//Format a value
Number::format(12345678.9);

// lamp a given number between two other numbers
Number::clamp(-2, 1, 100);
```