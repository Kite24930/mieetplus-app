<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomVerifyEmail extends VerifyEmail
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject(Lang::get('メールアドレスの件名'))
            ->greeting('こんにちは！')
            ->line(Lang::get('メールアドレスの検証を行うため下記のボタンをクリックしてください。'))
            ->action(Lang::get('メールアドレスを検証する'), $verificationUrl)
            ->line(Lang::get('もしアカウントを作成していない場合は追加の処理は必要ありません。'))
            ->salutation('Mieet Plus');
    }
}
