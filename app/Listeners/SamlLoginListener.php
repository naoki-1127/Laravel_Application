<?php

namespace App\Listeners;

use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SamlLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Saml2LoginEvent  $event
     * @return void
     */
    public function handle(Saml2LoginEvent $event)
    {
        //
        $messageId = $event->getSaml2Auth()->getLastMessageId();
        $user = $event->getSaml2User();

        $userData = [
            'id' => $user-> getUserId(),
            'attributes' => $user-> getAttributes(),
            'assertion' => $user -> getRawSamlAssertion(),
        ];

        $laravelUser = \App\User::where('email',$userData['attributes']['EmailAddress'])->first();
        Log::debug($laravelUser);
        
        if ($laravelUser) {
            Auth::login($laravelUser);
        } else {
            abort(401, 'Authorization Required');
        }
    }
}
