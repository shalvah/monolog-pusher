# monolog-pusher

[![Build Status](https://travis-ci.com/shalvah/monolog-pusher.svg?branch=master)](https://travis-ci.com/shalvah/monolog-pusher)
[![Latest Stable Version](https://poser.pugx.org/shalvah/monolog-pusher/v/stable)](https://packagist.org/packages/shalvah/monolog-pusher)

Monolog handler that sends logs to [Pusher Channels](https://pusher.com/channels).

## Usage
- Create a `Pusher` client:

```php
$pusher = new \Pusher\Pusher(
  'YOUR_APP_KEY', 
  'YOUR_APP_SECRET', 
  'YOUR_APP_ID', 
  [
    'cluster => 'YOUR_APP_CLUSTER'
  ]
);
```

- Create a new `PusherHandler` with your Pusher client:

```php
$handler = new \Shalvah\MonologPusher\PusherHandler($pusher);
```

- Alternatively, you can pass the Pusher config options directly to the Handler (as an array), so it can handle creation of the Pusher instance itself:

```php
$config = [
  'YOUR_APP_KEY', 
  'YOUR_APP_SECRET', 
  'YOUR_APP_ID',
  [
    'cluster => 'YOUR_APP_CLUSTER'
  ]
];
$handler = new \Shalvah\MonologPusher\PusherHandler($config);
```

- Attach this handler to your Monolog logger:

```php
$logger = new Logger('pusherLogs');
$logger->pushHandler($handler);
```

- Call the various log methods (`info`, `error`, `debug`and so forth) to send a log message to Pusher. The name of the Pusher channel used will be the name you set when creating your `Logger` (in the above example, "pusherLogs"). The event name used is *`log`*:

```php
$logger->error('oops!');
```

By default, the `PusherHandler` will only log messages of level **error** and above. You can change this by passing a minimum level as a second parameter to the constructor:

```php
$handler = new \Shalvah\MonologPusher\PusherHandler($pusher, \Monolog\Logger::DEBUG);
```

## Installation

```bash
composer require shalvah/monolog-pusher
```
