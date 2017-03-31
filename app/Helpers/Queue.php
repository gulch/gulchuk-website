<?php

use Bernard\Driver\PhpRedisDriver;
use Bernard\QueueFactory\PersistentFactory;
use Bernard\Serializer\SimpleSerializer;
use Bernard\Middleware\MiddlewareBuilder;
use Bernard\Producer;
use Bernard\Message\DefaultMessage;

class Queue
{
    const QUEUE_NAME = 'gulchuk.com:queue';

    /** @var $producer Producer */
    private $producer;

    public function init(): void
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->setOption(\Redis::OPT_PREFIX, self::QUEUE_NAME . ':');

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