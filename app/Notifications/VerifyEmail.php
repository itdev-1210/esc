<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends VerifyEmailNotification
{
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
                        'verification.verify',
                        Carbon::now()->addMinutes(60),
                        ['id' => $notifiable->getKey()]
        );
    }
}
