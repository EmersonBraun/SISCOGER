<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Wellcome extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // dd($notifiable);
        return (new MailMessage)
            ->from($notifiable->email)
            ->subject('Boas Vindas - SISCOGER')
            ->line('Você está recebendo este e-mail porque foi realizado seu cadastro no SISCOGER.')
            ->line('Para o primeiro acesso o login e senha são seu RG (apenas os números).')
            ->action('Acessar SISCOGER', route('login'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $notifiable->id,
            'name' => $notifiable->nome,
            'email' => $notifiable->email
        ];
    }
}
