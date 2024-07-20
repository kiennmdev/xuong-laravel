<?php

namespace App\Providers;

use App\Models\Catalogue;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $catalogues = Catalogue::query()->get();
        $tags = Tag::query()->get();
        View::share('catalogues', $catalogues);
        View::share('tags', $tags);

        Paginator::useBootstrapFive();
    }
}
