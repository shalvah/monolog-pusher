# monolog-pusher

[![Build Status](https://travis-ci.com/shalvah/monolog-pusher.svg?branch=master)](https://travis-ci.com/shalvah/monolog-pusher)
[![Latest Stable Version](https://poser.pugx.org/shalvah/monolog-pusher/v/stable)](https://packagist.org/packages/shalvah/monolog-pusher)

Monolog handler that sends logs to [Pusher Channels](https://pusher.com/channels).

## Installation

```bash
composer require shalvah/monolog-pusher
```

## Usage
- Create a new `PusherHandler`, passing in the [Pusher constructor options](https://github.com/pusher/pusher-http-php#pusher-channels-constructor) as an array:

```php
$config = ['YOUR_APP_KEY', 'YOUR_APP_SECRET', 'YOUR_APP_ID', ['cluster' => 'YOUR_APP_CLUSTER']];
$handler = new \Shalvah\MonologPusher\PusherHandler($config);
```

- Alternatively, if you've already got an existing `Pusher` instance, you can pass that to the handler:

```php
$pusher = new \Pusher\Pusher();
$handler = new \Shalvah\MonologPusher\PusherHandler($pusher);
```

- Attach the handler to your Monolog logger:

```php
$logger = new \Monolog\Logger('pusher-logs');
$logger->pushHandler($handler);
```

- Now you can call the various log methods (`info`, `error`, `debug`and so forth) on your logger to send a log message to Pusher. The name of the Pusher channel used will be the name you set when creating your `Logger` (in the above example, "pusher-logs"). The name of the event will be *`log`*:

```php
$logger->error('oops!');
```

By default, the `PusherHandler` will only log messages of level **error** and above. You can change this by passing a minimum level as a second parameter to the constructor:

```php
$handler = new \Shalvah\MonologPusher\PusherHandler($config, \Monolog\Logger::DEBUG);
```
