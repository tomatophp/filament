<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\User;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use TomatoPHP\FilamentAccounts\Models\Membership;
use TomatoPHP\FilamentAccounts\Models\Team;
use TomatoPHP\FilamentAccounts\Models\TeamInvitation;
use TomatoPHP\FilamentApi\Facades\FilamentAPI;
use TomatoPHP\FilamentCms\Facades\FilamentCMS;
use TomatoPHP\FilamentCms\Services\Contracts\CmsAuthor;
use TomatoPHP\FilamentCms\Services\Contracts\CmsType;
use TomatoPHP\FilamentCms\Services\Contracts\Section;
use TomatoPHP\FilamentCms\Services\FilamentCmsAuthors;

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
       URL::forceScheme('https');
    }
}
