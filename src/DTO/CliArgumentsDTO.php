<?php

namespace Theliver\WeatherCli\DTO;

use Theliver\WeatherCli\Enums\WeatherProviders;
use Theliver\WeatherCli\Enums\WeatherUnits;

final class CliArgumentsDTO
{
    private ?string $provider;
    private ?string $units;

    public function __construct(
        private string $city,
        ?string $units = null,
        ?string $provider = null,
    ) {
        $this->provider = $provider ?? WeatherProviders::OpenWeatherMap->name;
        $this->units = $units ?? WeatherUnits::Default->name;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @return string|null
     */
    public function getUnits(): ?string
    {
        return $this->units;
    }
}