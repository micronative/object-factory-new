<?php

namespace Micronative\ObjectFactory\Cache\Redis;

use Predis\Client;

class RedisClientFactory
{

    /** @var string */
    protected $configFile;

    /** @var \Micronative\ObjectFactory\Cache\Redis\RedisConfigFactory */
    protected $configFactory;

    /**
     * RedisClientFactory constructor.
     *
     * @param string|null $configFile
     * @throws \Micronative\ObjectFactory\Cache\Redis\Exceptions\RedisConfigException
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(?string $configFile = null)
    {
        $this->configFile = $configFile;
        $this->configFactory = new RedisConfigFactory($this->configFile);
    }

    /**
     * @param string|null $connection
     * @return \Predis\Client
     * @throws \Micronative\ObjectFactory\Cache\Redis\Exceptions\RedisConfigException
     */
    public function create(?string $connection = null): Client
    {
        /** @var \Micronative\ObjectFactory\Cache\Redis\RedisConfig $config */
        $config = $this->configFactory->get($connection);

        return new Client($config->toArray());
    }

}
