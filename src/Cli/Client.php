<?php

declare(strict_types=1);

namespace Theliver\WeatherCli\Cli;

use Theliver\WeatherCli\DTO\CliArgumentsDTO;
use Theliver\WeatherCli\Enums\WeatherProviders;
use Theliver\WeatherCli\Enums\WeatherUnits;
use Theliver\WeatherCli\Factories\WeatherProviderFactory;
use Theliver\WeatherCli\Formatters\OutputMessageFormatter;

final class Client
{
    public function __construct(private OutputMessageFormatter $outputMessageFormatter)
    {}

    /**
     * @param array $args
     * @return void
     * @throws \Exception
     */
    public function run(array $args): void
    {
        if (count($args) <= 1) {
            echo 'Weather APP requires at least one argument. Please provide a city.' . PHP_EOL;
            return;
        }

        $arguments = $this->parseArguments($args);

        $provider = $this->prepareProvider($arguments);

        $currentWeather = $provider->getCurrentWeather(
            $arguments->getCity(),
            WeatherUnits::createFromString(ucfirst(strtolower($arguments->getUnits())))
        );

        echo $this->outputMessageFormatter->format($currentWeather) . PHP_EOL;
    }

    private function parseArguments(array $args): CliArgumentsDTO
    {
        // Remove argv[0] from a variable.
        array_shift($args);

        return new CliArgumentsDTO(...$args);
    }

    /**
     * @param CliArgumentsDTO $arguments
     * @return \Theliver\WeatherCli\Providers\WeatherProvider
     * @throws \Exception
     */
    public function prepareProvider(CliArgumentsDTO $arguments): \Theliver\WeatherCli\Providers\WeatherProvider
    {
        $providerFactory = new WeatherProviderFactory();
        $provider = $providerFactory->make(WeatherProviders::createFromString($arguments->getProvider()));
        return $provider;
    }
}