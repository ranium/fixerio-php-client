# Fixer.io PHP Client

Provides an easy to use client for [fixer.io](https://fixer.io) exchange rates and currency conversion JSON API.

## Installation

This project can be installed using Composer:

``composer require ranium/fixerio-php-client``

## Usage

This package uses's [Guzzle's Service Description](https://github.com/guzzle/guzzle-services) to make HTTP Requests to the fixer.io API.

To use this package in your application, simply use the package and instantiate the client as follows

```php
use Ranium\Fixerio\Client;

$accessKey = '12345678901234567890';
$secure = true; // Optional, default is true (only paid plans of fixer.io supports SSL)
$config = []; // Optional, guzzle command client config that you might want to pass

$fixerio = Client::create($accessKey, $secure, $config);
```

Here's how you can access the fixer.io's endpoints:

*Note: `access_key` parameter is sent by default in all requests so no need to pass it in the argument while calling methods. However, you can include it should you want to override the access key used while instantiating the fixerio client.*

### [Latest rates endpoint](https://fixer.io/documentation#latestrates)

```php
$fixerio->latest(
    [
        'base' => 'USD', // optional
        'symbols' => 'INR', // optional
    ]
);
```  

### [Historical rates endpoint](https://fixer.io/documentation#historicalrates)

```php
$fixerio->historical(
    [
        'date' => '2019-01-01',
        'base' => 'USD', // optional
        'symbols' => 'INR', //optional
    ]
);
```

### [Convert endpoint](https://fixer.io/documentation#convertcurrency)

```php
$fixerio->convert(
    [
        'from' => 'USD',
        'to' => 'INR',
        'amount' => 50.75,
        'date' => '2019-01-01', //optional
    ]
);
```

### [Time-Series data endpoint](https://fixer.io/documentation#timeseries)

```php
$fixerio->timeseries(
    [
        'start_date' => '2019-01-01',
        'end_date' => '2019-01-05',
        'base' => 'USD', // optional
        'symbols' => 'INR', //optional
    ]
);
```

### [Fluctuation data endpoint](https://fixer.io/documentation#timeseries)

```php
$fixerio->fluctuation(
    [
        'start_date' => '2019-01-01',
        'end_date' => '2019-01-05',
        'base' => 'USD', // optional
        'symbols' => 'INR', //optional
    ]
);
```

The response for all the above calls will be a JSON object. Please refer fixer.io's [documentation](https://fixer.io/documentation) for further details about various endpoints, request parameters and response objects.
