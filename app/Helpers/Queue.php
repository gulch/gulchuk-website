<?php

namespace App\Helpers;

use Bernard\Driver\PhpRedisDriver;
use Bernard\QueueFactory\PersistentFactory;
use Bernard\Serializer\SimpleSerializer;
use Bernard\Middleware\MiddlewareBuilder;
use Bernard\Producer;
use Bernard\Message\DefaultMessage;
use Redis;

class Queue
{
    /** @var Producer */
    private $producer;

    private function init(): void
    {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->setOption(Redis::OPT_PREFIX, config('queue.name') . ':');

        $driver = new PhpRedisDriver($redis);

        $factory = new PersistentFactory($driver, new SimpleSerializer());
        $producer = new Producer($factory, new MiddlewareBuilder());

        $this->producer = $producer;
    }

    public function process(string $name, array $options = []): void
    {
        if (!$this->producer) {
            $this->init();
        }

        $this->producer->produce(
            new DefaultMessage($name, $options),
            'default'
        );
    }
}