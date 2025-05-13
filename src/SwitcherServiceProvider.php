<?php

namespace Luminee\Switcher;

use Illuminate\Support\ServiceProvider;
use Luminee\Switcher\Switcher;

class SwitcherServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $config = __DIR__ . '/../config';

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([$this->config . 'switcher.php' => config_path('switcher.php')]);
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->config = realpath($this->config) . DIRECTORY_SEPARATOR;

        if (file_exists($this->config . 'switcher.php')) {
            $this->mergeConfigFrom($this->config . 'switcher.php', 'switcher');
        }

        $this->app->singleton(Switcher::class, function ($app) {
            return new Switcher();
        });

        $this->app->alias(Switcher::class, 'switcher');
    }
}
