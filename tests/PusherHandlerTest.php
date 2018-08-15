<?php

namespace Shalvah\MonologPusher\Tests;

use Monolog\Logger;
use Shalvah\MonologPusher\PusherHandler;

class PusherHandlerTest extends \Mockery\Adapter\Phpunit\MockeryTestCase
{
    /**
     * The Pusher client test double
     *
     * @var \Mockery\Mock
     */
    private $pusher;

    protected function setUp()
    {
        parent::setUp();
        $this->pusher = \Mockery::mock(\Pusher\Pusher::class);
    }

    public function testLogMessagesGetSenttoPusher()
    {
        $message = 'something went wrong';
        $loggerName = 'testLogger';
        $this->pusher->shouldReceive('trigger')
            ->withArgs([
                $loggerName,
                'log',
                \Mockery::subset(['message' => $message])
            ]);
        $handler = new PusherHandler($this->pusher);
        $logger = new Logger($loggerName, [$handler]);
        $logger->error($message);
    }
}
