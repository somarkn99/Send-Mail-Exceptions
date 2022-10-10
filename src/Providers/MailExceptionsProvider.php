<?php

namespace somarkn99\SendMailExceptions\Providers;

use Illuminate\Support\ServiceProvider;

class MailExceptionsProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'SendMailExceptions');
    }
}
