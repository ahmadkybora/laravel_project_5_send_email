<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Hash;

class Register extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $timestamp = Carbon::now()->timestamp;
        $signature = Hash::make($notifiable->id . $notifiable->username . $timestamp);
        $user = $notifiable;
        //$url = 'http://localhost:8000/api/verify-email/user=' . $user->username . '/signature=' . $signature;
        $url = 'http://localhost:8000/api/verify-email';
        return (new MailMessage)
        ->subject('Activate Your Account')
        ->markdown('mail.user.register', 
        [
            'url' => $url,
            'signature' => $signature, 
            'timestamp' => $timestamp, 
            'user' => $user
        ]);
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
            //
        ];
    }
}
