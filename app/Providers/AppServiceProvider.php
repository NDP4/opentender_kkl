<?php

namespace App\Providers;

use App\Models\ContactSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['welcome', 'layouts.guest-with-nav'], function ($view) {
            $contactSettings = ContactSetting::first();
            $view->with('contactSettings', $contactSettings);
        });
    }
}
