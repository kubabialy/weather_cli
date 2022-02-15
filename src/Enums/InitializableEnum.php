<?php

namespace Theliver\WeatherCli\Enums;

interface InitializableEnum
{
    public static function createFromString(string $arg): self;
}