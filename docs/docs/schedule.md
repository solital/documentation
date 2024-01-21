Task scheduling is a commonly used technique for automating tasks based on a schedule. Such tasks may include backing up databases, processing a queue, or creating system usage reports, as they are required to be repeated regularly over time, or even indefinitely. It is better to schedule such tasks and monitor them so they can run predictably in a timely fashion.

## Usage

First, you must analyze whether the `default_timezone` variable in the `bootstrap.yaml` file is configured correctly. Otherwise, the schedule may be executed incorrectly.

To create a Schedule class, you must execute the following command entering the class name:

```bash
php vinci schedule UserSchedule
```

All schedules are stored in the `app/Schedule` folder.

## Schedule Structure

The standard structure of a schedule is as follows:

```php
<?php 

namespace Solital\Schedule;

use Solital\Core\Schedule\Schedule;
use Solital\Core\Schedule\ScheduleInterface;

/**
 * @generated class generated using Vinci Console
 */
class UserSchedule extends Schedule implements ScheduleInterface
{
	/**
	 * Construct with schedule time
	 */
	public function __construct()
	{
		$this->time = "everyMinute";
	}

	/**
	 * @return mixed
	 */
	public function handle(): mixed
	{
		return $this;
	}
}
```

The code that will be executed must be inside the `handle` method.

## Changing the time

To change the time that the schedule will run, you can change the `$time` property inside the constructor.

```php
public function __construct()
{
    $this->time = "everyMinute";
}
```

Solital makes use of the [php-cron-scheduler](https://packagist.org/packages/peppeocchi/php-cron-scheduler) component to schedule tasks. Therefore, you can access the documentation for that component to see the available options.

To make things easier, you can use one of the options below:

<table class="table">
  <thead>
    <tr>
      <th scope="col">Option</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="cmd-vinci">everyMinute</span></td>
      <td>Run every minute</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">hourly</span></td>
      <td>Run once per hour</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">daily</span></td>
      <td>Run once per day</td>
    </tr>
    <tr>
      <td><span class="cmd-vinci">at('* * * * *')</span></td>
      <td>This method accepts any expression supported by <a target="_blank" href="https://github.com/dragonmantank/cron-expression">dragonmantank/cron-expression</a></td>
    </tr>
  </tbody>
</table>

## Before job execution

In some cases you might want to run some code, if the job is due to run, before it's being executed. For example you might want to add a log entry, ping a url or anything else. To do so, you can call the before like the example below.

```php
public function before()
{
    // This code will be executed before the `handle` method
}
```

## After job execution

Sometime you might wish to do something after a job runs. The then methods provides you the flexibility to do anything you want after the job execution. The output of the job will be injected to this function. For example you might want to add an entry to you logs, ping a url etc

```php
public function after()
{
    // This code will be executed after the `handle` method
}
```

## Output

When a schedule is executed, an output of that schedule is generated within the `app/Storage/schedules/` folder.

## Running a schedule

There are two ways to run a schedule: using the `--run` option and using the `--work` option.

```bash
php vinci schedule --run

php vinci schedule --work
```