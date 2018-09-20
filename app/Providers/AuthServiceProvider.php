<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('usuarios', function () {
            return auth()->user()->type->id == 1;
        });        

        Gate::define('personas', function () {

            if (auth()->user()->type->id == 3  ||  auth()->user()->type->id == 4 ||  auth()->user()->type->id == 5) {
              
               return true;
            }
        });        

        Gate::define('predios', function () {
                          
            
            if ( auth()->user()->type->id == 2 ||  auth()->user()->type->id == 3  ||  auth()->user()->type->id == 4 ||  auth()->user()->type->id == 5) {
              
               return true;
            }
      
        });        

        Gate::define('procesos', function () {
                          
            if ( auth()->user()->type->id == 4 ||  auth()->user()->type->id == 5) {
              
               return true;
            }
      
        });
    }
}
