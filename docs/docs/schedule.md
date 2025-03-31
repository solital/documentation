## Introduction

Task scheduling is a commonly used technique for automating tasks based on a schedule. Such tasks may include backing up databases, processing a queue, or creating system usage reports, as they are required to be repeated regularly over time, or even indefinitely. It is better to schedule such tasks and monitor them so they can run predictably in a timely fashion.

## Usage

First, you must analyze whether the `default_timezone` variable in the `bootstrap.yaml` file is configured correctly. Otherwise, the schedule may be executed incorrectly.

To create a Schedule class, you must execute the following command entering the class name:

```bash
php vinci schedule UserSchedule
```

All schedules are stored in the `app/Schedule` folder.

### Schedule Structure

The standard structure of a schedule is as follows:

```php
<?php 

namespace Solital\Schedule;

use Solital\Core\Schedule\TaskSchedule;
use Solital\Core\Schedule\ScheduleInterface;

/**
 * @generated class generated using Vinci Console
 */
class UserSchedule extends TaskSchedule implements ScheduleInterface
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

<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">Since Solital Core 4.5.2, all schedules extend from the `TaskSchedule` class</h6>
</div>

The code that will be executed must be inside the `handle` method.

## Changing the time

Solital allows you to set a time for each task to run. You can use the `$time` property or attributes.

### Using "$time" property

<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">
    Using <span class="fw-bold">$time</span> property is deprecated and will be removed in future 5.0 version
    </h6>
</div>

To change the time that the schedule will run, you can change the `$time` property inside the constructor.

```php
public function __construct()
{
    $this->time = "everyMinute";
}
```

### Using Attributes

<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">This feature is available since Solital Core 4.5.2</h6>
</div>

Using properties may seem too simple for some people. Using attributes, you gain the ability to define what time or on what days a task will be executed.

See an example below:

```php
use Solital\Core\Schedule\Attribute\EveryMinute;
use Solital\Core\Schedule\TaskSchedule;
use Solital\Core\Schedule\ScheduleInterface;

#[EveryMinute()]
class EmailScheduler extends TaskSchedule implements ScheduleInterface
{
    public function handle(): mixed
    {    
        return $this;
    }
}
```

Unlike the `$time` property, you can change the time that schedules will run using the constructor attribute. You can see all the attributes available in the [Github repository](https://github.com/solital/core/tree/master/src/Schedule/Attribute).

<div class="alert alert-info mt-4" role="alert">
    <h6 class="fw-semibold">If you use the <span class="fw-bold">$time</span> property together with the attributes, the priority will be given to the attributes</h6>
</div>

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

## Using a schedule in development mode

If you need to use the task schedule when developing your project, use the `php vinci schedule` command passing the `--work` option.

```bash
php vinci schedule --work
```

When a schedule is executed, an output of that schedule is generated within the `app/Storage/schedules/` folder.

## Using a schedule in production mode

To run the task schedule in production mode, you must use the same command as above using the `--run` option. However, there are different ways to execute this command for each type of operating system.

### Linux

Add a new entry to your crontab to run `php vinci schedule` every minute.

```
* * * * * cd /path-to-your-project && php vinci schedule --run 1>> /dev/null 2>&1
```

That's it! Your scheduler is up and running, now you can add your jobs without worring anymore about the crontab.

### Windows

**Create a Scheduled Task**

1. Open *Task Scheduler*
2. Select _Create Task..._
3. Give the task a name and description
4. To run the task in the background, select _Run whether the user is logged on or not_ and check the _Hidden_ checkbox.

**Triggers**

1. Create a new trigger.
2. Set the trigger to run _Daily_ and recur every `1` days.
3. Set _Repeat task every_ to `1 minutes`. `1 minutes` is not a selectable option. Simply select `5 minutes` from the dropdown and then manually edit.
4. Set _for a duration of:_ to `Indefinitely`.
5. Ensure that _Enabled_ is checked.

**Actions**

1. Create a new action.
2. Start php by entering the php binary location, such as `C:\php\php.exe`
3. Set _Add arguments_ field to `C:\{project-dir}\vinci schedule --run` (replace `{project-dir}` with appropriate path).

**Settings**

1. Check _Allow task to be run on demand_.
2. Check _Run task as soon as possible after a scheduled start is missed_.

**Wrap-up**

1. To ensure that the task is running, find the task in the _Task Scheduler Library_.
2. Note the task _Status_. It may be _Ready_ or _Running_.
3. Note the _Next Run Time_ and _Last Run Time_ properties.