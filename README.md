# monolog-pusher

Monolog handler that sends logs to [Pusher Channels](https://pusher.com/channels).

## Usage
Create a `Pusher` client:

```php
$pusher = new \Pusher\Pusher('YOUR_APP_KEY', 'YOUR_APP_SECRET', 'YOUR_APP_ID');
```

Initialise the `PusherHandler` with your Pusher client, and attach this handler to your Monolog logger:

```php
$handler = new \Shalvah\MonologPusher\PusherHandler($pusher);
$logger = new Logger('pusherLogs');
$logger->pushHandler($handler);
```
Call the various log methods (`info`, `error`, `debug`, `critical`and so forth). Log messages will be sent to Pusher. The name of the Pusher channel used will be the name you set when creating your `Logger` (in the above example, "pusherLogs"):

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
