<?php

namespace Tests\Unit;

use Exception;
use PhpChannels\DiscordWebhook\Discord;
use PHPUnit\Framework\TestCase;

class DiscordTest extends TestCase
{   
    /**
     * Test Discord message() method.
     *
     * @return void
     */
    public function testMessage ()
    {
        $message = Discord::message();
        $this->assertInstanceOf(Discord::class, $message);
        $this->assertNull($message->webhook);

        $other_message = Discord::message('https://fake-webhook.com');
        $this->assertInstanceOf(Discord::class, $other_message);
        $this->assertEquals($other_message->webhook, 'https://fake-webhook.com');
    }

    /**
     * Test Discord setUsername() method.
     *
     * @return void
     */
    public function testSetUsername ()
    {
        $message = Discord::message();
        $this->assertNull($message->username);
        $message->setUsername('Test Bot');
        $this->assertEquals($message->username, 'Test Bot');
    }

    /**
     * Test Discord setAvatarUrl() method.
     *
     * @return void
     */
    public function testSetAvatarUrl ()
    {
        $message = Discord::message();
        $this->assertNull($message->avatar_url);
        $message->setAvatarUrl('https://fakeavatar.com');
        $this->assertEquals($message->avatar_url, 'https://fakeavatar.com');
    }

    /**
     * Test Discord setEmbeds() method.
     *
     * @return void
     */
    public function testSetEmbeds ()
    {
        $message = Discord::message();
        $this->assertEquals($message->embeds, []);
        $message->setEmbeds(['test' => 'unit']);
        $this->assertEquals($message->embeds, ['test' => 'unit']);
    }

    /**
     * Test Discord setContent() method.
     *
     * @return void
     */
    public function testSetContent ()
    {
        $message = Discord::message();
        $this->assertNull($message->content);
        $message->setContent('content');
        $this->assertEquals($message->content, 'content');
    }

    /**
     * Test Discord setAuthor() method.
     *
     * @return void
     */
    public function testSetAuthor ()
    {
        $message = Discord::message();
        $this->assertFalse(isset($message->embeds[0]['author']));

        $message->setAuthor('Murilo');
        $this->assertEquals($message->embeds[0]['author']['name'], 'Murilo');
        $this->assertEquals($message->embeds[0]['author']['url'], '');
        $this->assertEquals($message->embeds[0]['author']['icon_url'], '');

        $message->setAuthor('Murilo', 'https://fake-author.com');
        $this->assertEquals($message->embeds[0]['author']['name'], 'Murilo');
        $this->assertEquals($message->embeds[0]['author']['url'], 'https://fake-author.com');
        $this->assertEquals($message->embeds[0]['author']['icon_url'], '');

        $message->setAuthor('Murilo', 'https://fake-author.com', 'https://fake-icon.com');
        $this->assertEquals($message->embeds[0]['author']['name'], 'Murilo');
        $this->assertEquals($message->embeds[0]['author']['url'], 'https://fake-author.com');
        $this->assertEquals($message->embeds[0]['author']['icon_url'], 'https://fake-icon.com');
    }

    /**
     * Test Discord setTitle() method.
     *
     * @return void
     */
    public function testSetTitle ()
    {
        $message = Discord::message();
        $this->assertFalse(isset($message->embeds[0]['title']));

        $message->setTitle('Title');
        $this->assertEquals($message->embeds[0]['title'], 'Title');
    }

    /**
     * Test Discord setUrl() method.
     *
     * @return void
     */
    public function testSetUrl ()
    {
        $message = Discord::message();
        $this->assertFalse(isset($message->embeds[0]['url']));

        $message->setUrl('https://fake-url.com');
        $this->assertEquals($message->embeds[0]['url'], 'https://fake-url.com');
    }

    /**
     * Test Discord setDescription() method.
     *
     * @return void
     */
    public function testSetDescription ()
    {
        $message = Discord::message();
        $this->assertFalse(isset($message->embeds[0]['description']));

        $message->setDescription('description');
        $this->assertEquals($message->embeds[0]['description'], 'description');
    }

    /**
     * Test Discord setColor() method.
     *
     * @return void
     */
    public function testSetColor ()
    {
        $message = Discord::message();
        $this->assertFalse(isset($message->embeds[0]['color']));

        $message->setColor('#color');
        $this->assertEquals($message->embeds[0]['color'], '#color');
    }

    /**
     * Test Discord setThumbnail() method.
     *
     * @return void
     */
    public function testSetThumbnail ()
    {
        $message = Discord::message();
        $this->assertFalse(isset($message->embeds[0]['thumbnail']));

        $message->setThumbnail('https://fake-thumb.com');
        $this->assertEquals($message->embeds[0]['thumbnail']['url'], 'https://fake-thumb.com');
    }

    /**
     * Test Discord setImage() method.
     *
     * @return void
     */
    public function testSetImage ()
    {
        $message = Discord::message();
        $this->assertFalse(isset($message->embeds[0]['image']));

        $message->setImage('https://fake-image.com');
        $this->assertEquals($message->embeds[0]['image']['url'], 'https://fake-image.com');
    }

    /**
     * Test Discord setFooter() method.
     *
     * @return void
     */
    public function testSetFooter ()
    {
        $message = Discord::message();
        $this->assertFalse(isset($message->embeds[0]['footer']));

        $message->setFooter('text');
        $this->assertEquals($message->embeds[0]['footer']['text'], 'text');
        $this->assertEquals($message->embeds[0]['footer']['icon_url'], '');

        $message->setFooter('text', 'https://fake-icon.com');
        $this->assertEquals($message->embeds[0]['footer']['text'], 'text');
        $this->assertEquals($message->embeds[0]['footer']['icon_url'], 'https://fake-icon.com');
    }

    /**
     * Test Discord setFooter() method.
     *
     * @return void
     */
    public function testSetWebhook ()
    {
        $message = Discord::message();
        $this->assertNull($message->webhook);

        $message->setWebhook('https://fake-webhook.com');
        $this->assertEquals($message->webhook, 'https://fake-webhook.com');
    }

    /**
     * Test Discord setField() method.
     *
     * @return void
     */
    public function testSetField ()
    {
        $message = Discord::message();
        $this->assertFalse(isset($message->embeds[0]['fields']));

        $message->setField('Field 1', 'Value 1');
        $this->assertIsArray($message->embeds[0]['fields']);
        $this->assertContains(['name' => 'Field 1', 'value' => 'Value 1', 'inline' => null], $message->embeds[0]['fields']);
        $this->assertCount(1, $message->embeds[0]['fields']);

        $message->setField('Field 2', 'Value 2', false);
        $this->assertIsArray($message->embeds[0]['fields']);
        $this->assertContains(['name' => 'Field 2', 'value' => 'Value 2', 'inline' => false], $message->embeds[0]['fields']);
        $this->assertCount(2, $message->embeds[0]['fields']);

        $message->setField('Field 3', 'Value 3', true);
        $this->assertIsArray($message->embeds[0]['fields']);
        $this->assertContains(['name' => 'Field 3', 'value' => 'Value 3', 'inline' => true], $message->embeds[0]['fields']);
        $this->assertCount(3, $message->embeds[0]['fields']);
    }

    /**
     * Test Discord send() method.
     *
     * @return void
     */
    public function testSend ()
    {
        $this->expectException(Exception::class);
        Discord::message()->send();

        $this->expectException(Exception::class);
        Discord::message('https://fake-webhook.test.com')->send();
    }

    /**
     * Test Discord normalizeValue() method.
     * 
     * @dataProvider provideValues
     *
     * @param mixed $input
     * @param string $expected_output
     * @return void
     */ 
    public function testNormalizeValue($input, string $expected_output)
    {
        $message = Discord::message();
        $this->assertEquals($expected_output, $message->normalizeValue($input));
    }

    /**
     * Provide expected/actual values to tests
     *
     * @return array
     */
    public function provideValues() : array
    {
        return [
            [null, 'null'],
            [42, '42'],
            ['foo', 'foo'],
            [['a', 'b'], '["a","b"]'],
            [[], '[]'],
            [new \stdClass(), '{}']
        ];
    }
}
