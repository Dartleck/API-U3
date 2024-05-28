<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductoComprado extends Notification
{
    use Queueable;

    protected $producto;
    protected $comprador;

    /**
     * Create a new notification instance.
     */
    public function __construct($producto, $comprador)
    {
        $this->producto = $producto;
        $this->comprador = $comprador;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->subject('Tu producto ha sido comprado')
                    ->greeting('Hola ' . $notifiable->name . ',')
                    ->line('Tu producto "' . $this->producto->name . '" ha sido comprado por ' . $this->comprador->name . '.')
                    ->line('Gracias por usar nuestra aplicación.');
    }
}
