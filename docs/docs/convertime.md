<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">
    This class was removed in Core 4.4. Please use the <a href="https://solital.github.io/site/docs/4.x/date-and-time/">Temporal</a> component
    </h6>
</div>

It is possible to manipulate dates and times using the `Convertime` class. To begin, run the instance: 

```php
use Solital\Core\Validation\Convertime;

$convertime = new Convertime();
```

## Changing the timezone

In the class constructor, you can define the timezone. By default, the default 
timezone is set to `America/Sao_Paulo`.

```php
$convertime = new Convertime("America/Fortaleza");
```

You can change the timezone also in the `bootstrap.yaml` file:

```yaml
default_timezone: America/Fortaleza
```

## Format date

To format a date, enter the date you want to convert and the format to be converted.

```php
$convertime = new Convertime();
$res = $convertime->formatDate('04/01/1999', 'Y-m-d');

/* Return 1999-01-04 */
pre($res);
```

## Add months to a date

In some cases, you may need to add months to a specific date. To do this, use the `addMonth` class. 
This class is similar to the `formatDate` class, with the difference that you must enter 
in the last parameter the number of months that will be added to the date.

This class already has conversion for days with 28, 29, 30 or 31 days. 

```php
$convertime = new Convertime();
$res = $convertime->addMonth('1999-01-04', 'd/m/Y', 1);

/* Return 1999-02-04 */
pre($res);
```

## Add days to a date

To add days to a date, the `addDays` method works in a similar way to the` addMonth` method.  

```php
$convertime = new Convertime();
$res = $convertime->addDays('1999-01-04', 'd/m/Y', 3);

/* Return 1999-01-07 */
pre($res);
```

## Add time to another time

It is possible to add a specific time to another time. For example: add 3 more hours at 13:00.

```php
$convertime = new Convertime();
$res = $convertime->addHour('13:00', '03:00');

/* Return 16:00 */
pre($res);
```

## Check if the date is weekend

To check whether a certain date will be on a weekend, use the `isWeekend()` method.

```php
$convertime = new Convertime();
$res = $convertime->isWeekend('2021-07-18');

/* Return bool */
pre($res);
```