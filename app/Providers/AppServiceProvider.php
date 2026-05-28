<?php

namespace App\Providers;

use App\Models\Artist;
use App\Models\Band;
use App\Observers\ArtistObserver;
use App\Observers\BandObserver;
use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Band::observe(BandObserver::class);
        Artist::observe(ArtistObserver::class);

        TallStackUi::customize()
            ->card()->block('wrapper.class')->replace('rounded-lg', 'rounded-none')
            ->and()
            ->button()->block('wrapper.class')->replace('rounded-md', 'rounded-none')
            ->and()
            ->badge()->block('wrapper.class')->replace('rounded-full', 'rounded-none');
    }
}
