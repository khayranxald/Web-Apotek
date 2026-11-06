<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactMessageNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected string $senderName,
        protected string $senderEmail,
        protected string $senderPhone,
        protected string $messageContent
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pesan Baru dari Formulir Kontak')
            ->greeting('Pesan Baru Masuk')
            ->line('**Nama:** ' . $this->senderName)
            ->line('**Email:** ' . $this->senderEmail)
            ->line('**Telepon:** ' . $this->senderPhone)
            ->line('**Pesan:**')
            ->line($this->messageContent)
            ->salutation('Sistem Apotek Abidzar');
    }
}