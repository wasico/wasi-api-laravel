<?php

namespace App\Providers;

use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\ServiceProvider;

class HeaderContentProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Header pre-load
        view()->composer('template.partials.header', function($view) {
            $view->with('typesForSale', PropertiesController::getPropertyTypesByPurpose('for_sale'));
            $view->with('typesForRent', PropertiesController::getPropertyTypesByPurpose('for_rent'));
            $view->with('contactInfo', TemplateController::getContactInfo());
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
