<?php

namespace odinbi\material\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class OdinbiServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    // public function register()
    // {
    //     $this->registerPublish();
    // }

    public function boot()
    {
      $this->loadViewsFrom(__DIR__.'/../resources/views/components', 'elements');
      // $this->bladeViewComponent('elements',[
      //     'app-content'=>'app-content',
      //     'material-css'=>'material-css'
      // ]);
      $this->bladeViewComponent('elements');
      $this->registerPublish();

    }

    public function bladeViewComponent($view)
    {
      foreach ($this->loadComponentFile() as $prefix => $component) {
        Blade::component($view."::".$component."=>".$component);
      }
    }

     /**
     * Register publishable assets.
     *
     * @return void
     */
    protected function registerPublish()
    {
        $publishable = [
            'odb.material'    => [
                __DIR__.'/../resources/assets/' => public_path('odinbi/assets'),
                __DIR__.'/../resources/views' => resource_path('views/odinbi/material'),
            ],
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }

    }

    protected function getBaseName($filename)
    {
      return basename($filename,".blade.php");
    }

    // public function loadComponentFile()
    // {
    //   $components  = array() ;
    //   foreach (glob(__DIR__.'/../resources/views/components/*.php') as $filename) {
    //     $components [] = array (
    //       $this->getBaseName($filename) => $this->getBaseName($filename)
    //     );
    //   }
    //   return $components;
    // }
    public function loadComponentFile()
    {
      $components  = array() ;
      foreach (glob(__DIR__.'/../resources/views/components/*.php') as $filename) {
        array_push($components,$this->getBaseName($filename));
      }
      return $components;
    }
}