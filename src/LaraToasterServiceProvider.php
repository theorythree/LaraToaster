<?php

namespace TheoryThree\LaraToaster;

use Illuminate\Support\ServiceProvider;

class LaraToasterServiceProvider extends ServiceProvider
{

  protected $routeMiddleware = [
    'session' => \Illuminate\Session\Middleware\StartSession::class,
  ];

  /**
   * Perform post-registration booting of services.
   *
   * @return void
   */
  public function boot()
  {

    $this->publishes([
      __DIR__.'/../config/laratoaster.php' => config_path('laratoaster.php'),
      __DIR__.'/../js/components/LaraToaster.vue' => base_path('resources/js/components/LaraToaster.vue'),
    ], 'laratoaster');

  }

  /**
   * Register any package services.
   *
   * @return void
   */
  public function register()
  {
    // register app
    $this->app->bind('laratoaster', function($app) {
      return $this->app->make('TheoryThree\LaraToaster\LaraToaster');
    });

  }
}
