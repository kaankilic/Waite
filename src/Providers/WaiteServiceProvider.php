<?php 
namespace Kaankilic\Waite\Providers;
use Illuminate\Support\ServiceProvider;
class WaiteServiceProvider extends ServiceProvider {
  protected $defer = false;

   /**
     * Bootstrap the application services.
     *
     * @return void
    */
  public function boot(\Illuminate\Routing\Router $router){
    $this->publishes([
      __DIR__.'/../../config/waite.php' => config_path('waite.php')
    ]);
  }
 
  /**
    * Register the application services.
    *
    * @return void
  */
  public function register(){
    $this->mergeConfigFrom(__DIR__ . '/../../config/waite.php', 'waite');
    return array('Waite');
  }
}