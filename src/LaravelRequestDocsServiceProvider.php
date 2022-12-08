<?php

namespace Rakutentech\LaravelRequestDocs;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Rakutentech\LaravelRequestDocs\Commands\LaravelRequestDocsCommand;
use Route;

class LaravelRequestDocsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-request-docs')
            ->hasConfigFile('request-docs')
            ->hasViews()
            ->hasAssets()
            ->hasCommand(LaravelRequestDocsCommand::class);
    }

    public function packageBooted()
    {
        parent::packageBooted();

        Route::get(config('request-docs.url'), [\Rakutentech\LaravelRequestDocs\Controllers\LaravelRequestDocsController::class, 'index'])
            ->name('request-docs.index')
            ->middleware(config('request-docs.middlewares'));
        Route::get('request-docs/swagger', function () {
            return  \File::get(__DIR__.'/../public/swagger/index.html');
        });
        // swagger assets
        Route::get('request-docs/swagger/swagger-ui.css', function () {
            return  \File::get(__DIR__.'/../public/swagger/swagger-ui.css');
        });
        Route::get('request-docs/swagger/index.css', function () {
            return  \File::get(__DIR__.'/../public/swagger/index.css');
        });
        Route::get('request-docs/swagger/swagger-ui-bundle.js', function () {
            return  \File::get(__DIR__.'/../public/swagger/swagger-ui-bundle.js');
        });
        Route::get('request-docs/swagger/swagger-ui-standalone-preset.js', function () {
            return  \File::get(__DIR__.'/../public/swagger/swagger-ui-standalone-preset.js');
        });
        Route::get('request-docs/swagger/swagger-initializer.js', function () {
            return  \File::get(__DIR__.'/../public/swagger/swagger-initializer.js');
        });
    }
}
