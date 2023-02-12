<?php

namespace PhpChannels\DiscordWebhook;

use Exception;
use GuzzleHttp\Client;

class Discord 
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string|null
     */
    public $username;

    /**
     * @var string|null
     */
    public $avatar_url;

    /**
     * @var string
     */
    public $webhook;

    /**
     * @var array
     */
    public $embeds;

    /**
     * @var string|null
     */
    public $content;

    public function __construct()
    {
        $this->client = new Client();
        $this->embeds = [];
    }

    /**
     * Starts a new message.
     *
     * @param string|null $webhook
     * @return self
     */
    public static function message (?string $webhook = null): self
    {
        $self = new self();

        if ($webhook)
        {
            $self->setWebhook($webhook);
        }
        
        return $self;
    }

    /**
     * Sends request to webhook.
     *
     * @return void
     */
    public function send (): void
    {
        if (empty($this->webhook))
        {
            throw new Exception('Please set a Discord Webhook.', 400);
        }

        $json = [];

        if ($this->username)
        {
            $json['username'] = $this->username;
        }

        if ($this->avatar_url)
        {
            $json['avatar_url'] = $this->avatar_url;
        }

        if ($this->content)
        {
            $json['content'] = $this->content;
        }

        if (!empty($this->embeds))
        {
            $json['embeds'] = $this->embeds;
        }


        $response = $this->client->post($this->webhook, ['json' => $json]);  

        if ($response->getStatusCode() !== 204)
        {
            throw new Exception('Failed to request Discord Webhook.', $response->getStatusCode());
        }
    }

    /**
     * Sets username to payload.
     *
     * @param string $username
     * @return self
     */
    public function setUsername (string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Sets avatar_url to payload.
     *
     * @param string $avatar_url
     * @return self
     */
    public function setAvatarUrl (string $avatar_url): self
    {
        $this->avatar_url = $avatar_url;
        return $this;
    }

    /**
     * Sets ALL the embeds value to payload.
     *
     * @param array $embeds
     * @return self
     */
    public function setEmbeds (array $embeds): self
    {
        $this->embeds = $embeds;
        return $this;
    }

    /**
     * Sets content to payload.
     *
     * @param string $content
     * @return self
     */
    public function setContent (string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Sets author on embends to payload.
     *
     * @param string $name
     * @param string|null $url
     * @param string|null $icon_url
     * @return self
     */
    public function setAuthor (string $name, ?string $url = '', ?string $icon_url = ''): self
    {
        $this->embeds[0]['author'] = [
            'name'     => $name,
            'url'      => $url,
            'icon_url' => $icon_url,
        ];

        return $this;
    }

    /**
     * Sets title on embends to payload.
     *
     * @param string $title
     * @return self
     */
    public function setTitle (string $title): self
    {
        $this->embeds[0]['title'] = $title;
        return $this;
    }
    
    /**
     * Sets url on embends to payload.
     *
     * @param string $url
     * @return self
     */
    public function setUrl (string $url): self
    {
        $this->embeds[0]['url'] = $url;
        return $this;
    }

    /**
     * Sets description on embends to payload.
     *
     * @param string $description
     * @return self
     */
    public function setDescription (string $description): self
    {
        $this->embeds[0]['description'] = $description;
        return $this;
    }

    /**
     * Sets color on embends to payload.
     *
     * @param string $color
     * @return self
     */
    public function setColor (string $color): self
    {
        $this->embeds[0]['color'] = $color;
        return $this;
    }

    /**
     * Adds new fields on embends to payload.
     *
     * @param string $name
     * @param string $value
     * @param boolean|null $inline
     * @return self
     */
    public function setField (string $name, string $value, bool $inline = null): self
    {
        $fields = isset($this->embeds[0]['fields']) ? $this->embeds[0]['fields'] : [];

        $field = [
            'name'   => $name, 
            'value'  => $value,
            'inline' => $inline
        ];

        array_push($fields, $field);
        $this->embeds[0]['fields'] = $fields;

        return $this;
    }

    /**
     * Sets thumbnail on embends to payload.
     *
     * @param string $thumbnail
     * @return self
     */
    public function setThumbnail (string $thumbnail): self
    {
        $this->embeds[0]['thumbnail']['url'] = $thumbnail;
        return $this;
    }

    /**
     * Sets image on embends to payload.
     *
     * @param string $image
     * @return self
     */
    public function setImage (string $image): self
    {
        $this->embeds[0]['image']['url'] = $image;
        return $this;
    }

    /**
     * Sets footer on embends to payload.
     *
     * @param string $text
     * @param string|null $icon_url
     * @return self
     */
    public function setFooter (string $text,  ?string $icon_url = ''): self
    {
        $this->embeds[0]['footer'] = [
            'text'     => $text,
            'icon_url' => $icon_url,
        ];

        return $this;
    }

    /**
     * Sets the webhook to send the request.
     *
     * @param string $webhook
     * @return self
     */
    public function setWebhook (string $webhook): self
    {
        $this->webhook = $webhook;
        return $this;
    }
}