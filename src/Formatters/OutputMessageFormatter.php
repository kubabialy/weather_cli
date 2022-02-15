<?php

namespace Theliver\WeatherCli\Formatters;

use Theliver\WeatherCli\DTO\WeatherDTO;

final class OutputMessageFormatter
{
    private const TEMPLATE = '%s: %s, temperature: %s';

    public function format(WeatherDTO $weatherDTO): string
    {
        return sprintf(
            self::TEMPLATE,
            ucfirst($weatherDTO->getCity()),
            $weatherDTO->getDescription(),
            $weatherDTO->getTemperature(),
        );
    }
}