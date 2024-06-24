<?php

namespace App\Providers\Filament;

use Filament\Events\Auth\Registered;
use Filament\Events\TenantSet;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Event;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use TomatoPHP\FilamentAccounts\Filament\Pages\ApiTokens;
use TomatoPHP\FilamentAccounts\Filament\Pages\Auth\LoginAccount;
use TomatoPHP\FilamentAccounts\Filament\Pages\CreateTeam;
use TomatoPHP\FilamentAccounts\Filament\Pages\EditProfile;
use TomatoPHP\FilamentAccounts\Filament\Pages\EditTeam;
use TomatoPHP\FilamentAccounts\Filament\Pages\Auth\RegisterAccount;
use TomatoPHP\FilamentAccounts\FilamentAccountsSaaSPlugin;
use TomatoPHP\FilamentAccounts\Listeners\CreatePersonalTeam;
use TomatoPHP\FilamentAccounts\Listeners\SwitchTeam;
use TomatoPHP\FilamentAccounts\Models\Team;
use TomatoPHP\FilamentTranslations\FilamentTranslationsSwitcherPlugin;
use TomatoPHP\FilamentTranslations\Http\Middleware\LanguageMiddleware;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('app')
            ->path('app')
            ->passwordReset()
            ->emailVerification()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                Pages\Dashboard::class
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugin(FilamentTranslationsSwitcherPlugin::make())
            ->plugin(
                FilamentAccountsSaaSPlugin::make()
                    ->databaseNotifications()
                    ->checkAccountStatusInLogin()
                    ->APITokenManager()
                    ->editTeam()
                    ->deleteTeam()
                    ->teamInvitation()
                    ->showTeamMembers()
                    ->editProfile()
                    ->editPassword()
                    ->browserSesstionManager()
                    ->deleteAccount()
                    ->editProfileMenu()
                    ->registration()
                    ->useOTPActivation()
            );
    }

    public function boot()
    {

    }

    public function shouldRegisterMenuItem(): bool
    {
        return auth()->user()?->hasVerifiedEmail() && Filament::hasTenancy() && Filament::getTenant();
    }
}
