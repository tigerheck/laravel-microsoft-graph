<?php

namespace TigerHeck\MsGraph;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use TigerHeck\MsGraph\Console\MsGraphWebhookSubscribeCommand;

class MsGraphServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/msgraph.php', 'msgraph');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->configurePublishing();
        }
    }
    
    public function register()
    {
        $this->registerMsGraph();
    }

    public function configurePublishing()
    {
        $this->publishes([
            __DIR__.'/../config/msgraph.php' => config_path('msgraph.php'),
        ], 'config');

        $timestamp = date('Y_m_d_His', time());

        $this->publishes([
            __DIR__.'/database/migrations/create_msgraph_tokens_table.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_msgraph_tokens_table.php",
        ], 'migrations');
    }

    public function provides()
    {
        return ['msgraph'];
    }

    protected function registerMsGraph()
    {
        $this->app->bind('msgraph', function ($app) {
            return new MsGraphService();
        });
    }
}
