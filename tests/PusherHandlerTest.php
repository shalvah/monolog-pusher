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
    private $loggerName;
    private $message;

    protected function setUp()
    {
        parent::setUp();
        $this->pusher = \Mockery::mock('overload:Pusher\Pusher');
        $this->message = 'something went wrong';
        $this->loggerName = 'testLogger';
        $this->pusher->shouldReceive('trigger')
            ->withArgs([
                $this->loggerName,
                'log',
                \Mockery::subset(['message' => $this->message])
            ]);
    }

    public function testConstructionWorksWithConfigArray()
    {
        $handler = new PusherHandler([
            'fake_app_key',
            'fake_app_secret',
            'fake_app_id',
            [
                'cluster' => 'fake_app_cluster'
            ]
        ]);
        $logger = new Logger($this->loggerName, [$handler]);
        $logger->error($this->message);
    }

    public function testConstructionWorksWithPusherINstance()
    {
        $handler = new PusherHandler($this->pusher);
        $logger = new Logger($this->loggerName, [$handler]);
        $logger->error($this->message);
    }
}
