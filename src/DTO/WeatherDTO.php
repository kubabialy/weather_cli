<?php

declare(strict_types=1);

namespace Theliver\WeatherCli\DTO;

final class WeatherDTO
{
    public function __construct(
        private string $city,
        private string $temperature,
        private string $description,
    ) {}

    /**
     * City to which the weather forecast applies
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Current temperature of requested place
     *
     * @return string
     */
    public function getTemperature(): string
    {
        return $this->temperature;
    }

    /**
     * Short weathers description of requested place
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}