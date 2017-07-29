<?php

namespace Tg\EasyGraphApi\Helper;

trait SingletonTrait
{
    protected static $instance;

    final public static function getType()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }

    final private function __wakeup()
    {
    }

    final private function __clone()
    {
    }
}