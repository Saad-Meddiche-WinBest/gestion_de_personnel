<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('index', function ($view) {
            $name_of_table = $view->name_of_model . 's';

            if (!isset($view->data_of_table)) {
                $data = fetch_data_of_table($name_of_table);
                $view->with('data_of_table', $data);
            }

            if (!isset($view->informations_of_columns)) {
                $columns = fetch_columns_of_table($name_of_table);
                $view->with('informations_of_columns', $columns);
            }
        });

        View::composer(['edit', 'create'], function ($view) {
            $name_of_table = $view->name_of_model . 's';

            if (!isset($view->informations_of_columns)) {
                $columns = fetch_columns_of_table($name_of_table);
                $view->with('informations_of_columns', $columns);
            }
        });
    }
}
