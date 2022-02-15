<?php

namespace Theliver\Tests\Providers;

use Theliver\WeatherCli\Enums\WeatherUnits;
use Theliver\WeatherCli\Http\HttpClient;
use Theliver\WeatherCli\Providers\OpenWeatherMapProvider;
use PHPUnit\Framework\TestCase;

class OpenWeatherMapProviderTest extends TestCase
{
    public function testProvide(): void
    {
        $city = 'Tokio';
        $appId = 'some_api_key';
        $url = sprintf(
            'https://api.openweathermap.org/data/2.5/weather?q=%s&appid=%s&units=default',
            $city,
            $appId
        );

        $httpClient = $this->createMock(HttpClient::class);
        $httpClient->expects($this->once())
            ->method('get')
            ->with($url)
            ->willReturn([
                'coord' => [
                    'lon' => 123.12,
                    'lat' => 143.23,
                ],
                'weather' => [[
                    'id' => 555,
                    'main' => 'Clear',
                    'description' => 'mainly clear',
                    'icon' => '01d',
                ]],
                'base' => 'stations',
                'main' => [
                    'temp' => 282.55,
                    'feels_like' => 281.86,
                    'temp_min' => 280.37,
                    'temp_max' => 284.26,
                    'pressure' => 1023,
                    'humidity' => 100
                ],
                'visibility' => 16093,
                'wind' => [
                    'speed' => 1.5,
                    'deg' => 350
                ],
                'clouds' => [
                    'all' => 1
                ],
                'dt' => 1560350645,
                'sys' => [
                    'type' => 1,
                    'id' => 5122,
                    'message' => 0.0139,
                    'country' => "JP",
                    'sunrise' => 1560343627,
                    'sunset' => 1560396563
                ],
                'timezone' => -25200,
                'id' => 420006353,
                'name' => "Tokio",
                'cod' => 200
            ]);

        $provider = new OpenWeatherMapProvider(
            'some_api_key',
            $httpClient
        );

        $weather = $provider->getCurrentWeather($city, WeatherUnits::Default);

        $this->assertEquals('282K', $weather->getTemperature());
        $this->assertEquals($city, $weather->getCity());
        $this->assertEquals('mainly clear', $weather->getDescription());
    }
}
