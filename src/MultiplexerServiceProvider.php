<?php

namespace TaylorNetwork\Multiplexer;

use Illuminate\Support\ServiceProvider;

class MultiplexerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/multiplexer.php', 'multiplexer');
    }

    public function boot()
    {
        $this->publishes([__DIR__.'/config/multiplexer.php' => config_path() ], 'config');

        $this->app->bind('Multiplexer', Multiplexer::class);
    }
}