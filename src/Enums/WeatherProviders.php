<?php

declare(strict_types=1);

namespace Theliver\WeatherCli\Enums;

/**
 * Expandable list of weather forecast providers.
 */
enum WeatherProviders implements InitializableEnum
{
    case OpenWeatherMap;

    public static function createFromString(string $arg): self
    {
        return match ($arg) {
            self::OpenWeatherMap->name => self::OpenWeatherMap,
            default => throw new \Exception('Provider not found'),
        };
    }
}