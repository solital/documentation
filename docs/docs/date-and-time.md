<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">
    If you are looking for the old <span class="fw-bold">Convertime</span> class, use <a href="https://solital.github.io/site/docs/4.x/convertime/">this link</a>
    </h6>
</div>

## Introduction

Dates are an important part of any system. To manipulate dates in Solital, you can use the `Temporal` component. The `Temporal` component uses the `DateTimeImmutable` class.

```php
use Solital\Core\Resource\Temporal\Temporal;

$temporal = Temporal::now();
```

The `now()` method takes the current date and time.


### Returning in different formats

You can return a date using one of the following methods:

```php
$temporal->toAtom();
$temporal->toCookie();
$temporal->toISO8601Expanded();
$temporal->toRFC1036();
$temporal->toRFC1123();
$temporal->toRFC2822();
$temporal->toRFC3339();
$temporal->toRFC3339Extended();
$temporal->toRFC7231();
$temporal->toRFC822();
$temporal->toRFC850();
$temporal->toRSS();
$temporal->toW3C();
$temporal->toUnixTimestamp();
$temporal->toFormat('Y-m-d');
$temporal->toi18nFormat('YYYY-MM-dd'); // Available since Core 4.6.0
```

## Adding and removing date and time

Temporal has methods for adding and removing days, months and years to a date, and also adding and removing hours and minutes to a time.

### Days

**Add days to a date**

```php
$result = Temporal::now()->addDays(3)->toFormat('Y-m-d');
var_dump($result);
```

**Remove days from a date**

```php
$result = Temporal::now()->subDays(3)->toFormat('Y-m-d');
var_dump($result);
```

### Months

**Add months to a date**

```php
$result = Temporal::now()->addMonths(3)->toFormat('Y-m-d');
var_dump($result);
```

**Remove months from a date**

```php
$result = Temporal::now()->subMonths(3)->toFormat('Y-m-d');
var_dump($result);
```

### Years

**Add years to a date**

```php
$result = Temporal::now()->addYears(3)->toFormat('Y-m-d');
var_dump($result);
```

**Remove years from a date**

```php
$result = Temporal::now()->subYears(3)->toFormat('Y-m-d');
var_dump($result);
```

### Hours

**Add hours to a time**

```php
$result = Temporal::now()->addHours(3)->toFormat('H:i:s');
var_dump($result);
```

**Remove hours from a time**

```php
$result = Temporal::now()->subHours(3)->toFormat('H:i:s');
var_dump($result);
```

### Minutes

**Add minutes to a time**

```php
$result = Temporal::now()->addMinutes(3)->toFormat('H:i:s');
var_dump($result);
```

**Remove minutes from a time**

```php
$result = Temporal::now()->subMinutes(3)->toFormat('H:i:s');
var_dump($result);
```

### Set micro seconds

<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">Abailable since Core 4.6.0</h6>
</div>

```php
$result = Temporal::now()->setMicrosecond(10000)->toFormat('H:i:s');
var_dump($result);
```

## Returning specific times

The Temporal component has methods to return specific times from a date/time, such as years, days, name of the month, and others.

**Date**

<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">
    The methods <strong>getMonthName</strong> and <strong>getMonthShortName</strong> are deprecated since Core 4.6.0. Instead of, use <strong>getTextualMonth</strong> and <strong>getTextualShortMonth</strong> methods
    </h6>
</div>

```php
Temporal::now()->getDay();
Temporal::now()->getYear();
Temporal::now()->getMonthInt();
Temporal::now()->getMonthName(); // Deprecated
Temporal::now()->getMonthName(); // Deprecated
```

The methods below are available since Core 4.6.0

```php
Temporal::now()->getTextualDay();
Temporal::now()->getTextualShortDay();
Temporal::now()->getTextualMonth();
Temporal::now()->getTextualShortMonth();
Temporal::now()->getLastDayOfMonth();
Temporal::now()->getEasterDate();
Temporal::now()->getEasterDateOrthodox();
```

**Time**

```php
Temporal::now()->getHour();
Temporal::now()->getMinute();
Temporal::now()->getSecond();
Temporal::now()->getMicrosecond(); // Available since Core 4.6.0
```

## Date on different days

If you want to manipulate a date other than the current date, you can use the `createDatetime()` method. This method, you can create a custom date and time.

```php
echo Temporal::createDatetime('2024-04-04 08:20:10')->toRFC1123();
```

Or, you can use `createFromTimeStamp` method (available since Core 4.6.0). This method has a polyfill to PHP 8.3.

```php
echo Temporal::createFromTimeStamp('1703155440')->toRFC1123();
```

If you need to get the date of the previous day, the current day or the next day, there are three methods to do this job.

```php
Temporal::today()->toRFC1036();
Temporal::yesterday()->toRFC1036();
Temporal::tomorrow()->toRFC1036();
```

## Check days of the week

Temporal also has methods to check whether the current date is a specific day of the week. All methods below return `true` or `false`.

```php
Temporal::now()->isMonday();
Temporal::now()->isTuesday();
Temporal::now()->isWednesday();
Temporal::now()->isThursday();
Temporal::now()->isFriday();
Temporal::now()->isSaturday();
Temporal::now()->isSunday();
Temporal::now()->isWeekend();
Temporal::now()->isLeapYear(); // Available since Core 4.6.0
```

## Returning DateTimeImmutable instance

To return an instance of type `DateTimeImmutable`, use the `getDateTimeImmutableInstance` method.

```php
$temporal = Temporal::createDatetime('2024-04-04');
$immutable_datetime = $temporal->addMonths(3);
$modify_datetime = $temporal->toFormat('Y-m-d');

var_dump($immutable_datetime->getImmutableDateTime()->format('Y-m-d')); // 2024-04-04
var_dump($modify_datetime); // 2024-07-04
```