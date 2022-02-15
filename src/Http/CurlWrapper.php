<?php

namespace Theliver\WeatherCli\Http;

/**
 * This class is only used to create an abstraction around the PHP cURL library.
 * Its main purpose is to facilitate the testing of existing functionality.
 * For more advanced applications, it would be better to use a ready-made library.
 */
final class CurlWrapper
{
    private ?\CurlHandle $handle;

    public function __construct(string $url)
    {
        $this->handle = curl_init($url);
    }

    public function setOption(int $option, mixed $value): void
    {
        curl_setopt($this->handle, $option, $value);
    }

    public function execute(): string|bool
    {
        return curl_exec($this->handle);
    }

    public function close(): void
    {
        curl_close($this->handle);
        $this->handle = null;
    }

    public function __destruct()
    {
        // Check if handle is closed
        if ($this->handle) {
            $this->close();
        }
    }
}