<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\PropertiesController;

class FooterContentProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Footer pre-load
        view()->composer('template.partials.footer', function($view){
            $view->with('contactInfo', TemplateController::getContactInfo());
            $view->with('latestThreeProperties', PropertiesController::getLatestProperties(3)['properties']);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
