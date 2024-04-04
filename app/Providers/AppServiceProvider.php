<?php

namespace App\Providers;

use App\Models\Proposal;
use App\Observers\ProposalObserver;
use App\Observers\MediaObserver;
use Illuminate\Support\ServiceProvider;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        Proposal::observe(ProposalObserver::class);
        // Media::observe(MediaObserver::class);
    }
}
