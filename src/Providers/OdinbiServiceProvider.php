<?php

namespace odinbi\material\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class OdinbiServiceProvider extends ServiceProvider
{
    public function boot()
    {
      // $this->loadRoutesFrom(__DIR__.'/../../routes/dashboard-theme.php');
      // $this->loadViewsFrom(__DIR__.'/../../resources/views', 'dashboard-theme');
      $this->loadViewsFrom(__DIR__.'/../../resources/views/components', 'elements');
      $this->bladeViewComponent('elements',[
          'app-content'=>'app-content'
      ]);

      $this->publishes([
          __DIR__.'/../../resources/assets/' => public_path('odinbi/material'),
      ], 'public');
  
      $this->publishes([__DIR__.'/../../resources/views/components' => resource_path('views/odinbi/material'),
      ]);

    }

    public function bladeViewComponent($view,array $components)
    {
      foreach ($components as $prefix => $component) {
        Blade::component($view."::".$component,$prefix);
      }
    }
}