<?php
namespace Framework\Config;

class Config implements ConfigInterface
{
    private static $config = [];
    public static function getConfig()
    {
        return self::$config;
    }
    public static function setConfig(string $configSource)
    {
        if (is_readable($configSource)) {
            /** @noinspection PhpIncludeInspection */
            self::$config = require $configSource;
        } else {
            throw new \Exception('Bad config file: ' . $configSource);
        }
    }
    public static function addConfig(string $configSource)
    {
        if (is_readable($configSource)) {
            /** @noinspection PhpIncludeInspection */
            $config       = require $configSource;
            self::$config = array_merge(self::$config, $config);
        } else {
            throw new \Exception('Bad config file: ' . $configSource);
        }
    }
}