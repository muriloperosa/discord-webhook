# PHP Discord Webhook

PHP package that contains a set of methods for simple, direct and elegant communication with Discord channels via Webhooks.

## Composer

### Install
```sh
composer require ...
```

### Update

```sh
composer update ...
```

## QA

### Unit Tests

To run unit tests using PHPUnit:

```sh
./vendor/bin/phpunit ./tests
```

### PHP Stan

To run code static analysis using PHP Stan:

```sh
./vendor/bin/phpstan analyse
```

## Usage

The main goal of this package is to allow highly customizable messages to be sent to Discord channels in a simple and semantic way via Webhooks. The base payload used to build the code can be accessed at [`./documentation/payload.json`](https://github.com/muriloperosa/discord-webhook/blob/main/documentation/payload.json).

### Basic Usage

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message()
    ->setUsername('My Bot')
    ->setContent('Hello World!')
    ->send();
``` 

![image](https://user-images.githubusercontent.com/45050585/218355168-65a2e18b-5f04-4f8f-9f0b-858a4f1045c1.png)


## Changelog
Coming soon...

## Authors
Coming soon...
