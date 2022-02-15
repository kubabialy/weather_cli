<?php

namespace Theliver\Tests\Factories;

use PHPUnit\Framework\TestCase;
use Theliver\WeatherCli\Enums\WeatherProviders;
use Theliver\WeatherCli\Factories\WeatherProviderFactory;
use Theliver\WeatherCli\Providers\OpenWeatherMapProvider;

class WeatherProviderFactoryTest extends TestCase
{
    public function testShouldPassWithSupportedProvider(): void
    {
        $_ENV['OPEN_WEATHER_API_KEY'] = 'foo';
        $factory = new WeatherProviderFactory();
        $provider = $factory->make(WeatherProviders::OpenWeatherMap);

        $this->assertInstanceOf(
            expected: OpenWeatherMapProvider::class,
            actual: $provider
        );
    }
}
