<?php

namespace App\Providers;

use App\Department;
use App\Role;
use Illuminate\Support\ServiceProvider;

class ProdViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         view()->composer(['layouts.navbar','layouts.app'], function($view){
            $prodListRoute = ['products.view'];
            $manageProdRoute = ['addproduct.view'];
            $addProdRoute = ['addproduct.view'];
            $reportsRoute = ['report.view'];
            $registerRoute = ['register'];

            $productRoute = [
                'products.view',
                'addproduct.view'
            ];


            $view->with(compact(
                'productRoute',
                'manageProdRoute',
                'addProdRoute',
                'prodListRoute',
                'reportsRoute',
                'registerRoute'
            ));
         });

         view()->composer(['auth.register'], function($view){
            $departments = Department::pluck('name', 'id')->toArray();
            $roles = Role::pluck('description', 'id')->toArray();
            $view->with(compact('departments','roles'));
         });
         
    }
}
