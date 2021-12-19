<?php

namespace App\Providers;

use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Aacotroneo\Saml2\Events\Saml2LoginEvent' =>[
            'App\Listeners\SamlLoginListener',
        ],
        'Aacotroneo\Saml2\Events\Saml2LogoutEvent' =>[
            'App\Listeners\SamlLogoutListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        
        /* Event::listen('Aacotroneo\Saml2\Events\Saml2LoginEvent', function(Saml2LoginEvent $event){
            $messageId = $event->getSaml2Auth()->getLastMessageId();
            $user = $event->getSaml2User();

            $userData = [
                'id' => $user->getUserId(),
                'attributes' => $user->getAttributes(),
                'assertion' => $user->getRawSamlAssertion()
            ];
            $laravelUser = \App\User::where('email',$userData['attributes']['EmailAddress'])->first();

            if ($laravelUser) {
                Auth::login($laravelUser);
            } else {
                abort(401, 'Authorization Required');
            }
        Event::listen('Aacotroneo\Saml2\Events\Saml2LogoutEvent', function ($event) {
            Auth::logout();
            Session::save();
        });
        }); */
    }
}
