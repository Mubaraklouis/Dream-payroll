<?php

namespace App\Notifications;

use App\Mail\NewPayment as MailNewPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPayment extends Notification
{
    use Queueable;

    private $payment;

    /**
     * Create a new notification instance.
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ["database", "mail"];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): Mailable
    {
        return (new MailNewPayment($this->payment))
                    ->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "message" => "You have received your month salary of " . $this->payment->created_at->format("M Y"),
            "net_salary" => $this->payment->net_salary,
        ];
    }

    // public function withDelay(object $notifiable): array
    // {
    //     return [
    //         "database" => now(),
    //         "mail" => now()->addMinutes(1),
    //     ];
    // }
}
