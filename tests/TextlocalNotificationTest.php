<?php

namespace NotificationChannels\Textlocal\Test;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Mockery as M;
use NotificationChannels\Textlocal\Textlocal;
use NotificationChannels\Textlocal\TextlocalChannel;
use PHPUnit\Framework\TestCase;

class TextlocalNotificationTest extends TestCase
{
    /** @var Textlocal|M\MockInterface */
    private $sms;


    /** @var TextlocalChannel */
    private $channel;

    /** @var \DateTime */
    public static $sendAt;

    public function setUp(): void
    {
        $this->sms = M::mock(Textlocal::class, 'username', 'hash');

        $this->channel = new TextlocalChannel($this->sms);
    }

    public function tearDown(): void
    {
        M::close();
    }

    public function test_it_can_send_a_notification(): void
    {
        $this->sms->shouldReceive('setUnicodeMode')
            // ->once()
            ->with(false)
            ->andReturn($this->sms);

        $this->sms->shouldReceive('sendSms')
            // ->once()
            ->with('+1234567890', 'test-template', null);
        

        $this->channel->send(new TestNotifiable(), new TestNotification());
    }

    public function test_it_can_send_a_notification_to_multiple_phones(): void
    {
        $this->sms->shouldReceive('send')
            ->once()
            ->with(
                ['+1234567890', '+0987654321', '+1234554321'],
                'hello',
                'John_Doe',
            );

        $this->channel->send(new TestNotifiableWithManyPhones(), new TestNotification());
    }
}

class TestNotifiable
{
    use Notifiable;

    // Laravel v5.6+ passes the notification instance here
    // So we need to add `Notification $notification` argument to check it when this project stops supporting < 5.6
    public function routeNotificationForTextlocal()
    {
        return '+1234567890';
    }
}

class TestNotifiableWithoutRouteNotificationForTextlocal extends TestNotifiable
{
    public function routeNotificationForTextlocal()
    {
        return false;
    }
}

class TestNotifiableWithManyPhones extends TestNotifiable
{
    public function routeNotificationForsmsru()
    {
        return ['+1234567890', '+919706353416', '+1234554321'];
    }
}

class TestNotification extends Notification
{
    public function toSms()
    {
        return 'test-template';
    }
}
