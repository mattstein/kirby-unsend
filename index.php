<?php

use GuzzleHttp\Exception\GuzzleException;
use Kirby\Email\Email;
use Unsend\Exceptions\InvalidArgumentException;
use Unsend\Exceptions\MissingArgumentException;
use Unsend\Unsend;
use Kirby\Cms\App as Kirby;

class UnsendEmailProvider extends Email
{
    /**
     * @throws InvalidArgumentException
     * @throws MissingArgumentException
     * @throws GuzzleException
     * @throws JsonException
     */
    public function send(): bool
    {
        $unsend = Unsend::create(
            option('mattstein.unsend.apiKey'),
            option('mattstein.unsend.url')
        );

        $response = $unsend->sendEmail([
            'to' => current(array_keys($this->to())),
            'from' => $this->from(),
            'subject' => $this->subject(),
            'html' => $this->body()->html(),
            'text' => $this->body()->text(),
        ]);

        return isset($response->getData()->emailId) &&
            ! empty($response->getData()->emailId);
    }
}

Kirby::plugin('mattstein/unsend', [
    'options' => [
        'apiKey' => getenv('UNSEND_API_KEY'),
        'url' => getenv('UNSEND_URL'),
    ],
    'components' => [
        'email' => static function ($kirby, $props, $debug) {
            return new UnsendEmailProvider($props, $debug);
        }
    ]
]);
