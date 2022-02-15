<?php

namespace Theliver\Tests\Formatters;

use Theliver\WeatherCli\DTO\WeatherDTO;
use Theliver\WeatherCli\Formatters\OutputMessageFormatter;
use PHPUnit\Framework\TestCase;

class OutputMessageFormatterTest extends TestCase
{
    public function testFormat()
    {
        $weatherDto = new WeatherDTO('Amsterdam', '15C', 'mainly sunny');
        $formatter = new OutputMessageFormatter();

        $result = $formatter->format($weatherDto);
        $this->assertEquals('Amsterdam: mainly sunny, temperature: 15C', $result);
    }
}
