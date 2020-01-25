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

    /**
     * PusherHandler constructor.
     *
     * @param array|Pusher $pusher The Pusher instance to use or config options to create one
     * @param bool|int $level
     * @param bool $bubble
     */
    public function __construct($pusher, $level = Logger::ERROR, $bubble = true)
    {
        if (is_array($pusher)) {
            $pusher = new Pusher(...$pusher);
        }
        parent::__construct($level, $bubble);
        $this->pusher = $pusher;
    }

    protected function write(array $record): void
    {
        $this->pusher->trigger($record['channel'], 'log', $record);
    }
}
