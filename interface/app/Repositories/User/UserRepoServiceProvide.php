<?php 

namespace App\Repositories\User;

use Illuminate\Support\ServiceProvider;

class UserRepoServiceProvide extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

     public function boot(){}

     public function register()
     {
        $this->app->bind('App\Repositories\User\UserInterface',
        'App\Repositories\User\UserInterface');
     }
}