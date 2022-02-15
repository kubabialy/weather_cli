# Weather CLI

The Weather CLI, as the name suggests, is a micro application that gives you the weather at the location you specify.

The tool, apart from setting the city of course, allows you to set the units of measurement in which the data should be displayed. ## Installation

## Installation

Application can be installed in a various way, depending on your liking.

Currently, regardless of how you want to "install" this tool, you do have to clone this repository.

The simplest way is to clone the repo and run file `weather`:
```bash
$ cd /to/where/you/want/to/clone/it
$ git clone git@github.com:kubabialy/weather_cli.git
$ ./weather Berlin
>> Berlin: broken clouds, temperature: 282K
```

Then once you have the code, you can create `.env` from `.env.example` and paste your API key to the correct environmental variable.

If you don't have PHP installed on your machine and are not interested in installing it either, then you can use [Docker](https://docker.com):
```bash
$ cd /to/where/you/want/to/clone/it
$ git clone git@github.com:kubabialy/weather_cli.git
$ docker build -t weather_app .
$ docker run weather_app ./weather Berlin
>> Berlin: broken clouds, temperature: 282K
```

A decent idea would to paste one of those commands to an alias in your bashrc or zshrc (or whatever you are using).
```bash
alias="docker run weather_app ./weather Berlin"
# OR
alias="~/path/to/the/repo/weather"
```

Which would allow you to use it like so:
```bash
$ weather Helsinki
>> Helsinki: broken clouds, temperature 274K
```

## Usage

Regardless of how this tool is used, the information returned to the console will always be the same. The following examples should provide a good explanation.

```bash
$ ./weather London Metric
>> London: light rain, temperature: 9C
```

Currently, only one provider is supported, which is [OpenWeatherMap](https://openweathermap.org).
In the future, when more could be added, allowing for actually using third parameter of the tool.
```bash
$ ./weather London Imperial SomeOtherWeatherProvider
>> London: light rain, temperature: 48F
```

For the sake of simplicity and the little time spent on writing this application, 
if you want to check the weather in cities with double-headed names, you must put the name of the city in quotation marks.

```bash
$ ./weather "New York"
>> New York: clear sky, temperature: 264K
```

Additionally, you can specify the country and state of place you want to check the weather of like so:
```bash
$ ./weather "Warsaw, US"
>> Warsaw US: clear sky, temperature: 262K
```

## Technologies used and "gotchas"

Code was written in PHP8.1 and assumes that you have that version installed on your machine or are able to utilize Docker to run it with.

You do not have to run `composer install` after cloning this repository as it was written in a way that wouldn't require any external libraries to work.
If you want to play with the code, you do have `PHPUnit` installed in dev dependencies so that you can test it along the way.

There's a tiny `Dockerfile` so that you don't have to set up PHP for yourself on a local machine.

Important note, there are places where some shortcuts were taken and in normal circumstances an external library would be used.
One of those examples is an actual call to an API where only `cURL` with a wrapper was used to provide some abstraction, on 'production' grade software I would recommend using Guzzle or some similar lib.

The idea was to make this code fairly easy to extend if needed but to not over-engineer it by using DDD, CQRS and other design patterns that in normal circumstances are great.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.
