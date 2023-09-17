<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class invoices extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $invoice;
    public $user_create;
    public function __construct($invoice,$user_create)
    {
        $this->invoice=$invoice;
        $this->user_create=$user_create;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'invoice'=>$this->invoice,
            'user_create'=>$this->user_create,
            'title'=>'تم اضافة فاتورة ',
        ];
    }
}
