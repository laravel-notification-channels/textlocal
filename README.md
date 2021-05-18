# Textlocal SMS Notifications Channel for Laravel

This package allows to send SMS using Textlocal API using laravel notifications

Supports Laravel 5.5 to 6.x, 7.x

# Found any bugs or improvement open an issue or send me a PR

[![Latest Stable Version](https://poser.pugx.org/msonowal/laravel-notification-channel-textlocal/v/stable)](https://packagist.org/packages/msonowal/laravel-notification-channel-textlocal)
[![License](https://poser.pugx.org/msonowal/laravel-notification-channel-textlocal/license)](https://packagist.org/packages/msonowal/laravel-notification-channel-textlocal)
[![Total Downloads](https://poser.pugx.org/msonowal/laravel-notification-channel-textlocal/downloads)](https://packagist.org/packages/msonowal/laravel-notification-channel-textlocal)

This package makes it easy to send notifications using [textlocal](https://www.textlocal.in/) the Laravel way



## Contents

- [Installation](#installation)
	- [Setting up the textlocal service](#setting-up-the-textlocal-service)
- [Usage](#usage)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

Create an account in textlocal then create an API key or hash(password).

`composer require msonowal/laravel-notification-channel-textlocal`

### Setting up the Textlocal service

default textlocal config update as desired
```
return [
	'username'  => env('TEXTLOCAL_USERNAME'),
	'password'  => env('TEXTLOCAL_PASSWORD'),
	'hash'      => env('TEXTLOCAL_HASH'),
	'api_key'   => env('TEXTLOCAL_API_KEY'),
	'sender'    => env('TEXTLOCAL_SENDER'),
	'request_urls' => [
		'IN' => 'https://api.textlocal.in/',
		'UK' => 'https://api.txtlocal.com/'
	],
	'country'   => env('TEXTLOCAL_COUNTRY', 'IN'),
];
```
### Configuring .env 
```
    TEXTLOCAL_USERNAME=Your email id or api key
    TEXTLOCAL_HASH=get it from url '/docs/' under your API KEYS section of textlocal
    TEXTLOCAL_API_KEY get it from url '/docs/' under your API KEYS section of textlocal
    TEXTLOCAL_SENDER=Name of the Sender that will be displayed to the recipient (max 6 Characters).
    TEXTLOCAL_COUNTRY=Your Two letter(ISO-3166-alpha-2) Country Code. It should be the Country of the TEXTLOCAL account. defaulted to IN
```

### Publish Config
```
    php artisan vendor:publish --tag=textlocal
```

Currently, only textlocal of two country is supported IN(India) and UK(United Kingdom). 

## Usage

Implement this method `routeNotificationForTextlocal()` in your notifiable class/model which will return array of mobile numbers. Please make sure the mobile number contains the dial code as well (e.g +91 for India). And lastly implement `toSms()` method in the notification class which will return the (string) sms or template that is defined in textlocal account that needs to be send.

And if you want to have a specific sender based on Notification, e.g. like you are sending promotional notification using one and another for transaction then you can just define this method in your notification class which will return your sender id for that notification only
```
public function getUnicodeMode()
{
	return 'YOUR_SENDER_ID';
}
```

Unicode support
If you want to send the notification content to have unicode support set define this method in your notification which will return boolean based on which the sms will set the unicode mode in textlocal API
```
getUnicodeMode
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email manash149@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Manash Jyoti Sonowal](https://github.com/msonowal)
- [Mr Ejang](https://github.com/tomonsoejang)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## TODO
Need to convert to Guzzle Http as a Client in core
Add more countries
add tests
