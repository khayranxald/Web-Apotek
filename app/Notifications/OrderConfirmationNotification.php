<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderConfirmationNotification extends Notification
{
    use Queueable;

    public function __construct(protected Order $order)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pesanan Anda Berhasil Dibuat - ' . $this->order->order_number)
            ->greeting('Halo, ' . $this->order->recipient_name . '!')
            ->line('Terima kasih telah berbelanja di Apotek Abidzar. Pesanan Anda telah berhasil dibuat dan sedang diproses.')
            ->line('**Nomor Pesanan:** ' . $this->order->order_number)
            ->line('**Total Pembayaran:** Rp' . number_format($this->order->total, 0, ',', '.'))
            ->line('**Status:** ' . ucfirst($this->order->status))
            ->action('Lihat Detail Pesanan', route('orders.show', $this->order))
            ->line('Jika Anda memiliki pertanyaan, silakan hubungi kami melalui halaman Kontak.')
            ->salutation('Salam sehat, Tim Apotek Abidzar');
    }
}