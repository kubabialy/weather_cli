<?php

namespace Theliver\WeatherCli\Formatters;

use Theliver\WeatherCli\DTO\WeatherDTO;

final class OutputMessageFormatter
{
    private const TEMPLATE = '%s: %s. Current temperature is: %s';

    public function format(WeatherDTO $weatherDTO): string
    {
        return sprintf(
            self::TEMPLATE,
            strtoupper($weatherDTO->getCity()),
            $weatherDTO->getDescription(),
            $weatherDTO->getTemperature(),
        );
    }
}