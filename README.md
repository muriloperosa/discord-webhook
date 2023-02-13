# PHP Discord Webhook
![php workflow](https://github.com/muriloperosa/discord-webhook/actions/workflows/php.yml/badge.svg)

<br/>

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

## General

The main goal of this package is to allow highly customizable messages to be sent to Discord channels in a simple and semantic way via Webhooks. The base payload used to build the code can be accessed at [`./documentation/payload.json`](https://github.com/muriloperosa/discord-webhook/blob/main/documentation/payload.json).

### Basic Usage

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setUsername('My Bot')
    ->setContent('Hello World!')
    ->send();
``` 

![image](https://user-images.githubusercontent.com/45050585/218355168-65a2e18b-5f04-4f8f-9f0b-858a4f1045c1.png)

### 1. Define Webhook
There are two ways which the destination webhook of the message can be defined. The first is to pass the URL of the webhook as parameter to the `message (?string $webhook = null)` method, as in the example below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path');
// ...
```
Or the webhook can be set via the `setWebhook (string $webhook)` method, as in the second example:
```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message()
    ->setWebhook('https://discord.com/api/webhooks/your-webhook-path');
// ...
```

### 2. Username
The name of the sender of the message can be set using the `setUsername (string $username)` method, as in the example below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setUsername('Murilo Perosa')
    ->setContent('Hello World!')
    ->send();
```

[IMAGE]

### 3. Avatar
Coming soon...

### 4. Content
Coming soon...
### 5. Embeds
Coming soon...

## Dealing with Embeds

### 1. Author
Coming soon...

### 2. Title
Coming soon...

### 3. URL
Coming soon...

### 4. Description
Coming soon...

### 5. Color
Coming soon...

### 6. Fields
Coming soon...

### 7. Thumbnail
Coming soon...

### 8. Image
Coming soon...

### 9. Footer
Coming soon...


## Changelog
Coming soon...

## Authors
Coming soon...
