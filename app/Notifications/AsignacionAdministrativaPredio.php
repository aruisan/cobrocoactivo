<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AsignacionAdministrativaPredio extends Notification
{
    use Queueable;
    protected $user;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail' ,'database'];
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
                    ->greeting($notifiable->name. "." )
                    ->subject('Has sido seleccionado para administrar un predio')
                    ->line('Has sido seleccionado para administrar un predio')
                    ->action('Ir a la Notificacion', route('unnassigned'))
                    ->line('Gracias por usar CobroCoactivo');
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
            'link' => route('unnassigned'),
            'text' => "Has sido seleccionado para administrar un predio",
            'name' => $this->user->name,
        ];
    }
}
