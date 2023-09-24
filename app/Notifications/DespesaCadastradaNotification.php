<?php

namespace App\Notifications;

use App\Models\Despesa;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DespesaCadastradaNotification extends Notification
{
    use Queueable;

    protected $despesa;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Despesa $despesa)
    {
        $this->despesa = $despesa;
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
            ->line('Uma nova despesa foi cadastrada.')
            ->line('Descrição da Despesa: ' . $this->despesa->descricao)
            ->line('Data da Despesa: ' . $this->despesa->data)
            ->line('Valor da Despesa: R$ ' . $this->despesa->valor)
            ->action('Ver Despesa', url('/despesas/' . $this->despesa->id))
            ->line('Obrigado por usar nosso aplicativo!');
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
            'despesa_id' => $this->despesa->id,
            'message' => 'Uma nova despesa foi cadastrada.',
        ];
    }
}
