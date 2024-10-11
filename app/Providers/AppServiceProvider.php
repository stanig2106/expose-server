<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laminas\Uri\Uri;
use Laminas\Uri\UriFactory;
use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;
use React\Http\Browser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        UriFactory::registerScheme('capacitor', Uri::class);
        UriFactory::registerScheme('chrome-extension', Uri::class);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadConfigurationFile();

        $this->setMemoryLimit();

        $this->app->singleton(LoopInterface::class, function () {
            return Loop::get();
        });

        $this->app->bind(Browser::class, function ($app) {
            return new Browser($app->make(LoopInterface::class));
        });
    }

    protected function loadConfigurationFile()
    {
        $builtInConfig = config('expose-server');

        $keyServerVariable = 'EXPOSE_CONFIG_FILE';
        if (array_key_exists($keyServerVariable, $_SERVER) && is_string($_SERVER[$keyServerVariable]) && file_exists($_SERVER[$keyServerVariable])) {
            $localConfig = require $_SERVER[$keyServerVariable];
            config()->set('expose-server', array_merge($builtInConfig, $localConfig));

            return;
        }

        $localConfigFile = getcwd() . DIRECTORY_SEPARATOR . '.expose-server.php';

        if (file_exists($localConfigFile)) {
            $localConfig = require $localConfigFile;
            config()->set('expose-server', array_merge($builtInConfig, $localConfig));

            return;
        }
    }

    protected function setMemoryLimit()
    {
        ini_set('memory_limit', config()->get('expose-server.memory_limit', '128M'));
    }
}
