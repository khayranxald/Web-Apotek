<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusUpdatedNotification extends Notification
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
        $statusLabels = [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'processing' => 'Sedang Diproses',
            'shipped' => 'Dalam Pengiriman',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        $statusLabel = $statusLabels[$this->order->status] ?? ucfirst($this->order->status);

        return (new MailMessage)
            ->subject('Update Status Pesanan - ' . $this->order->order_number)
            ->greeting('Halo, ' . $this->order->recipient_name . '!')
            ->line('Status pesanan Anda telah diperbarui.')
            ->line('**Nomor Pesanan:** ' . $this->order->order_number)
            ->line('**Status Terbaru:** ' . $statusLabel)
            ->action('Lihat Detail Pesanan', route('orders.show', $this->order))
            ->salutation('Salam sehat, Tim Apotek Abidzar');
    }
}