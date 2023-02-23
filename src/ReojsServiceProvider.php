<?php

namespace OEngine\Reojs;

use Illuminate\Support\ServiceProvider;
use OEngine\LaravelPackage\ServicePackage;
use OEngine\LaravelPackage\WithServiceProvider;

class ReojsServiceProvider extends ServiceProvider
{
    use WithServiceProvider;

    public function configurePackage(ServicePackage $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         */
        $package
            ->name('reojs')
            ->hasConfigFile()
            ->hasViews()
            ->hasHelpers()
            ->hasAssets()
            ->hasTranslations()
            ->runsMigrations()
            ->RouteWeb()
            ->runsSeeds();
    }
}
