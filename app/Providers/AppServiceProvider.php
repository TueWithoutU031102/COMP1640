<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\IdeaService;
use App\Services\SubmissionService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(IdeaService::class, function ($app) {
            return new IdeaService();
        });
        $this->app->bind(UserService::class, function ($app) {
            return new UserService();
        });
        $this->app->bind(CategoryService::class, function ($app) {
            return new CategoryService();
        });
        $this->app->bind(SubmissionService::class, function ($app) {
            return new SubmissionService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
