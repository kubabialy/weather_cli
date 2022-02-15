<?php

declare(strict_types=1);

namespace Theliver\WeatherCli\Factories;

use Theliver\WeatherCli\Http\BasicClient;
use Theliver\WeatherCli\Http\CurlWrapper;
use Theliver\WeatherCli\Providers\OpenWeatherMapProvider;
use Theliver\WeatherCli\Providers\WeatherProvider as Provider;
use Theliver\WeatherCli\Enums\WeatherProviders as RequestedProvider;

class WeatherProviderFactory
{
    /**
     * @param RequestedProvider $requestedProvider
     * @return Provider
     */
    public function make(RequestedProvider $requestedProvider): Provider
    {
        return match ($requestedProvider) {
            RequestedProvider::OpenWeatherMap => new OpenWeatherMapProvider($_ENV['OPEN_WEATHER_MAP_API_KEY']),
        };
    }

    private function createOpenWeatherMapProvider(): OpenWeatherMapProvider
    {
        $httpClient = new BasicClient(
            new CurlWrapper('https://some_api.com/v1')
        );

        return new OpenWeatherMapProvider(
            apiKey: $_ENV['OPEN_WEATHER_MAP_API_KEY'],
            httpClient: $httpClient,
        );
    }
}