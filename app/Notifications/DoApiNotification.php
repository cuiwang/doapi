<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DoApiNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return  ['mail'];//只需要邮件通知
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->data['subject'])
            ->greeting($this->data['greeting'])
                    ->line($this->data['line1'])
                    ->line($this->data['line2'])
                    ->line($this->data['line3'])
                    ->action($this->data['action'], url($this->data['url']))
                    ->line($this->data['line4']);
    }

    /**
     * Get the array representation of the notification.
     *实体并返回原生的 PHP 数组。返回的数组会被编码为 JSON 格式然后存放到 notifications 表的 data 字段
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            'mydata'=>'toArray',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            //
            'mydata'=>'toDatabase',
        ];
    }
}
