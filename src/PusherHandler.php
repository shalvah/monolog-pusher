<?php

namespace Shalvah\MonologPusher;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Pusher\Pusher;

class PusherHandler extends AbstractProcessingHandler
{
    /**
     * @var Pusher
     */
    protected $pusher;

    public function __construct(Pusher $pusher, $level = Logger::ERROR, $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->pusher = $pusher;
    }

    protected function write(array $record)
    {
        $this->pusher->trigger($record['channel'], 'log', $record);
    }
}
