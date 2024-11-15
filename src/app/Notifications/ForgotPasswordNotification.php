<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class ForgotPasswordNotification extends ResetPasswordNotification
{
    /**
     * @param $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reset Your Password')
            ->greeting('Hello,')
            ->line('You are receiving this email because we received a password reset request for your account.')
            // ->action('Reset Password', $resetUrl)
            ->line('Token: ' . $this->token)
            ->line('If you did not request a password reset, no further action is required.');
    }
}

