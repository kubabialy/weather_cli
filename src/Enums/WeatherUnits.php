<?php

namespace Theliver\WeatherCli\Enums;

enum WeatherUnits implements InitializableEnum
{
    /**
     * Temperature units: Kelvin
     * Speed: meters/second
     */
    case Default;

    /**
     * Temperature units: Celsius
     * Speed: meters/second
     */
    case Metric;

    /**
     * Temperature units: Fahrenheit
     * Speed: miles/hour
     */
    case Imperial;

    public static function createFromString(string $arg): InitializableEnum
    {
        return match ($arg) {
            self::Metric->name => self::Metric,
            self::Imperial->name => self::Imperial,
            default => self::Default,
        };
    }
}