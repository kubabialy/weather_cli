<?php

namespace Theliver\WeatherCli\Http;

/**
 * NOTE: The following implementation is by no means "complete", it only serves to separate the interaction with external
 * APIs using the HTTP protocol from the logic involved in the management of the acquired data itself and should not be treated as a production solution.
 */
class BasicClient implements HttpClient
{
    /**
     * @param string $url
     * @return array
     * @throws \Exception
     */
    public function get(string $url): array
    {
        $wrapper = new CurlWrapper($url);
        $wrapper->setOption(CURLOPT_RETURNTRANSFER, 1);
        $res = $wrapper->execute();
        $wrapper->close();


        $json = json_decode($res, true, flags: JSON_OBJECT_AS_ARRAY);

        return $json;
    }
}