<?php

namespace App\Providers;

use App\Repositories\MarkRepository;
use App\Repositories\StudentRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\MarkInterface;
use App\Repositories\Interfaces\StudentInterface;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(
            StudentInterface::class, 
            StudentRepository::class
        );
        $this->app->bind(
            MarkInterface::class, 
            MarkRepository::class
        );
    }
}
