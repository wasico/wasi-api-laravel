<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\PropertiesController;

class SidebarContentProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // sidebar content pre-load
        view()->composer('properties.properties-sidebar', function ($view) {
            $view->with('propertyTypes', PropertiesController::getAllPropertyTypes());
            $view->with('propertyPurposes', PropertiesController::getPropertiesPurpose());
            $view->with('priceRanges', PropertiesController::getPriceRange());
            $view->with('areaRanges', PropertiesController::getAreaRange());
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
