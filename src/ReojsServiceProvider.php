<?php

namespace OEngine\Reojs;

use Illuminate\Support\ServiceProvider;
use OEngine\LaravelPackage\ServicePackage;
use OEngine\LaravelPackage\WithServiceProvider;
use OEngine\Reojs\Livewire\LivewireLoader;

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
    public function packageRegistered()
    {
        add_action(PACKAGE_SERVICE_PROVIDER_BOOT, function ($bootPackage) {
            LivewireLoader::Register($bootPackage->package->basePath('/Http/Livewire'), $bootPackage->getNamespaceName() . '\\Http\\Livewire', $bootPackage->package->shortName() . '::');
        });
    }
}
