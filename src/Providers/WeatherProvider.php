<?php

declare(strict_types=1);

namespace Theliver\WeatherCli\Providers;

use Theliver\WeatherCli\DTO\WeatherDTO;
use Theliver\WeatherCli\Enums\WeatherUnits;

interface WeatherProvider
{
    public function getCurrentWeather(string $city, WeatherUnits $units): WeatherDTO;
}