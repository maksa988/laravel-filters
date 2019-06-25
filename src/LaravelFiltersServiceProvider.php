<?php

namespace Maksa988\LaravelFilters;

use Illuminate\Support\ServiceProvider;
use Maksa988\LaravelFilters\Console\FilterMakeCommand;

class LaravelFiltersServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            FilterMakeCommand::class
        ]);
    }
}