<?php

namespace App\Notifications;

use App\Models\Prescription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PrescriptionReviewedNotification extends Notification
{
    use Queueable;

    public function __construct(protected Prescription $prescription)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $isApproved = $this->prescription->status === 'approved';

        $message = (new MailMessage)
            ->subject('Resep Anda Telah Direview')
            ->greeting('Halo!')
            ->line($isApproved
                ? 'Kabar baik! Resep yang Anda unggah telah disetujui oleh apoteker kami.'
                : 'Resep yang Anda unggah telah direview oleh apoteker kami, namun belum dapat disetujui.'
            )
            ->line('**Status:** ' . ($isApproved ? 'Disetujui' : 'Ditolak'));

        if ($this->prescription->pharmacist_note) {
            $message->line('**Catatan Apoteker:** ' . $this->prescription->pharmacist_note);
        }

        return $message
            ->action('Lihat Detail Resep', route('prescriptions.index'))
            ->salutation('Salam sehat, Tim Apotek Abidzar');
    }
}