<?php

namespace Theliver\WeatherCli\Http;

interface HttpClient
{
    /**
     * Performs a GET request, then returns the response body converted to an array.
     *
     * @param string $url API URL request is going to send to
     * @return array
     */
    public function get(string $url): array;
}