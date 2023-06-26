<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // The File facade provides a convenient way to interact with the file system in Laravel.
        // The glob() method is used to search for files in a directory using a pattern.
        // In this case, File::glob(app_path('Models/*.php')) fetches all the PHP files within the app/Models directory.
        // The app_path() helper function returns the absolute path to the app directory. 
        // The basename() function is a PHP function used to extract the filename from a path.
        $modelFiles = File::glob(app_path('Models/*.php'));

        foreach ($modelFiles as $modelFile) {
            $modelName = basename($modelFile, '.php');

            $modelClass = 'App\\Models\\' . $modelName;

            if (class_exists($modelClass)) {

                $factory = Factory::new($modelClass);
                $factory->count(10)->create();
            }
        }
    }
}
