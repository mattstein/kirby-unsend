# Unsend Email Provider for Kirby CMS

## Overview

This plugin allows Kirby’s email component to send messages with [Unsend](https://unsend.dev), an open source email platform that uses Amazon SES.

Once installed and configured properly, any message sent via Kirby’s standard `kirby()->email()` will be handled by Unsend’s API.

## Installation

Install via Composer:

```
composer require mattstein/kirby-unsend
```

## Configuration

Set an `UNSEND_API_KEY` environment variable, and `UNSEND_URL` if you self-host (example: `https://unsend.example.com`).

Alternatively, you can specify your API key and URL in `site/config/config.php`:

```php
return [
    'mattstein.unsend' => [
        'apiKey' => 'your-api-key',
        'url' => 'https://unsend.example.com',
    ],
    // ...
];
```
