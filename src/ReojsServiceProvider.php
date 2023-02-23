<?php

namespace OEngine\Reojs;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use OEngine\LaravelPackage\ServicePackage;
use OEngine\Platform\Traits\WithServiceProvider;
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
        add_filter(PLATFORM_DO_COMPONENT, function ($param) {
            if (isset($param['type']) && $param['type'] === 'livewire' && isset($param['name']) && $param['name']) {
                return [
                    'html' => Livewire::mount($param['name'], isset($param['params']) ? $param['params'] : [])->html(),
                    'error_code' => 0
                ];
            }
            return $param;
        });
    }
    public function packageBooted()
    {
        add_action(PLATFORM_HEAD_AFTER, function () {
            echo  Livewire::styles();
        });
        add_action(PLATFORM_BODY_AFTER, function () {
            echo  Livewire::scripts();
        });
    }
}
