<?php

declare(strict_types=1);

namespace Theliver\WeatherCli\Providers;

use Theliver\WeatherCli\DTO\WeatherDTO;
use Theliver\WeatherCli\Enums\WeatherUnits;
use Theliver\WeatherCli\Http\BasicClient;
use Theliver\WeatherCli\Http\CurlWrapper;
use Theliver\WeatherCli\Http\HttpClient;

final class OpenWeatherMapProvider implements WeatherProvider
{
    private const CITY_WEATHER_ENDPOINT_TEMPLATE = 'https://api.openweathermap.org/data/2.5/weather?q=%s&appid=%s&units=%s';

    /**
     * By default, this object httpClient is set to use BasicClient implementation of HttpClient
     */
    public function __construct(
        private string $apiKey,
        private HttpClient $httpClient = new BasicClient(),
    ) {}

    /**
     * @param string $city
     * @param WeatherUnits $units
     * @return WeatherDTO
     * @throws \Exception
     */
    public function getCurrentWeather(string $city, WeatherUnits $units): WeatherDTO
    {
        $response = $this->httpClient
            ->get($this->prepareRequestUrl($city, $units));

        $this->handlePossibleError($response);

        $convertedTemp = match ($units) {
            WeatherUnits::Default => sprintf('%sK', (int) $response['main']['temp']),
            WeatherUnits::Imperial => sprintf('%sF', (int) $response['main']['temp']),
            WeatherUnits::Metric => sprintf('%sC', (int) $response['main']['temp']),
        };

        return new WeatherDTO($city, $convertedTemp, $response['weather'][0]['description']);
    }

    public function handlePossibleError(array $message): void
    {
        if (!array_key_exists('message', $message) || (int) $message['cod'] !== 404) {
            return;
        }

        exit('Requested city was not found. Please try again, with a proper name.'.PHP_EOL);
    }

    private function prepareRequestUrl(string $city, WeatherUnits $units): string
    {
        return sprintf(self::CITY_WEATHER_ENDPOINT_TEMPLATE, $city, $this->apiKey, strtolower($units->name));
    }
}