<?php
namespace Framework\Config;

interface ConfigInterface
{
    public static function getConfig();

    public static function setConfig(string $configSource);
    public static function addConfig(string $configSource);
}