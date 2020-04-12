<?php

namespace TaylorNetwork\Multiplexer;

use Illuminate\Support\ServiceProvider;

class MultiplexerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/multiplexer.php', 'multiplexer');

        $this->publishes([ __DIR__ . '/config' => config_path()], 'config');
    }

    public function boot()
    {
        $this->app->bind('Multiplexer', Multiplexer::class);
    }
}