<?php

namespace FamilyTree365\Geneanum;

class GeneanumServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->mergeConfigFrom(__DIR__ . '/config/geneanum.php', 'geneanum');
    }


    public function register()
    {
        parent::register();
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/geneanum.php' => config_path('geneanum.php')
            ], 'config'
            );
        }
    }
}
