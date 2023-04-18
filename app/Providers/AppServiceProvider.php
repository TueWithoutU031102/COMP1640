<?php

namespace App\Providers;

use App\Http\Controllers\CommentController;
use App\Services\CategoryService;
use App\Services\CommentService;
use App\Services\EmailService;
use App\Services\FileService;
use App\Services\IdeaService;
use App\Services\MailService;
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
        $this->app->singleton(IdeaService::class, function ($app) {
            return new IdeaService();
        });
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService();
        });
        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService();
        });
        $this->app->singleton(SubmissionService::class, function ($app) {
            return new SubmissionService();
        });
        $this->app->singleton(EmailService::class, function ($app) {
            return new EmailService();
        });
        $this->app->singleton(CommentService::class, function ($app) {
            return new CommentService();
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
