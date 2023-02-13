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

![image](https://user-images.githubusercontent.com/45050585/218358617-b0c2565b-2ca3-41ed-a25f-e3edae2de885.png)

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
The avatar of the sender of the message can be set using the `setAvatar (string $avatar_url)` method, as in the example below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setUsername('My Bot')
    ->setContent('Hello World!')
    ->setAvatar('https://fake-avatar.com/avatar.png')
    ->send();
```

[IMAGE]

### 4. Content
A simple text content of the message can be set using the `setContent (string $content)` method, as in the example below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setContent('A simple text message you want to send!')
    ->send();
```

[IMAGE]
### 5. Embeds
However, the message content can be enriched through the `setEmbeds (array $embeds)` method, which takes an array as a parameter, enabling a wide range of customizations, as in the example below: 

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setEmbeds(['color' => '123456', 'title' => 'Embed content!'])
    ->send();
```
[IMAGE]
## Working with Embeds

Working with embeds content through a single array that fully handles this property is very powerful and can certainly be very useful on many occasions. But it can get really confusing when we are working with a very large array of settings, making it difficult to read and maintain the code. To solve this problem methods for manipulating embeds were added to the package, which are described below.
### 1. Author

To handle the `embeds[0]['author']` property, the `setAuthor (string $name, ?string $url = '', ?string $icon_url = '')` method can be used, as in the examples below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setAuthor('Author Name')
    ->send();

// optional param $url
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setAuthor('Author Name', 'https://fake-author.com')
    ->send();

// optional param $icon_url
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setAuthor('Author Name', 'https://fake-author.com', 'https://fake-icon.com/icon.png')
    ->send();
```
[IMAGE]

### 2. Title
To handle the `embeds[0]['title']` property, the `setTitle (string $title)` method can be used, as in the examples below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setTitle('Your title here!')
    ->send();
```
[IMAGE]
### 3. URL
To handle the `embeds[0]['url']` property, the `setUrl (string $url)` method can be used, as in the examples below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setUrl('https://fake-url.com')
    ->send();
```
[IMAGE]

### 4. Description
To handle the `embeds[0]['description']` property, the `setDescription (string $description)` method can be used, as in the examples below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setDescription('Your description here!')
    ->send();
```
[IMAGE]

### 5. Color
To handle the `embeds[0]['color']` property, the `setColor (string $color)` method can be used, as in the examples below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setColor('#57F287')
    ->send();
```
[IMAGE]

### 6. Fields
To add fields to `embeds[0]['fields']` property, the `setField (string $name, string $value, bool $inline = null)` method can be used, as in the examples below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setField('Name', 'Value')
    ->send();

// optional param $inline
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setField('Name', 'Value', true)
    ->send();

// multiple fields
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setField('Name 1', 'Value 1')
    ->setField('Name 2', 'Value 2', true)
    ->send();
```
> Note: This method can be invoked several times, each time adding a new field to the array.

<br/>

[IMAGE]



### 7. Thumbnail
To add fields to `embeds[0]['thumbnail']` property, the `setThumbnail (string $thumbnail)` method can be used, as in the examples below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setThumbnail('https://fake-thumb.com/thumb.png')
    ->send();
```
[IMAGE]

### 8. Image
To add fields to `embeds[0]['image']` property, the `setImage (string $image)` method can be used, as in the examples below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setImage('https://fake-image.com/image.png')
    ->send();
```
[IMAGE]

### 9. Footer
To add fields to `embeds[0]['footer']` property, the `setFooter (string $text,  ?string $icon_url = '')` method can be used, as in the examples below:

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setFooter('Text to footer here!')
    ->send();

// optional param $icon_url
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setFooter('Text to footer here!', 'https://fake-icon.com/icon.png')
    ->send();
```
[IMAGE]
## Usage Example

```php
use PhpChannels\DiscordWebhook\Discord;
...
Discord::message('https://discord.com/api/webhooks/your-webhook-path')
    ->setUsername('Application Bot')
    ->setAvatarUrl('https://fake-avatar.com/avatar.png')
    ->setContent('Content here!')
    ->setColor('#57F287')
    ->setTitle('Title here!')
    ->setDescription('Description here!')
    ->send();
```
> Note: The above example is for documentation purposes only, and that all the methods presented in this file can be combined to send the message as you need.

<br/>

[IMAGE]

## Changelog
All notable changes to this project will be documented in this section.

## [1.0.0] - 2023-02-13
### Added
- First release of the package! You can now perform composer installation of the package on PHP projects with version 7.3 and higher.