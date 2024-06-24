<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Tenancy\EditTeamProfile;
use App\Filament\Pages\Tenancy\RegisterTeam;
use App\Models\Team;
use EightyNine\Reports\ReportsPlugin;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use ProtoneMedia\Splade\Http\SpladeMiddleware;
use TomatoPHP\FilamentApi\FilamentAPIPlugin;
use TomatoPHP\FilamentMediaManager\FilamentMediaManagerPlugin;
use TomatoPHP\FilamentMenus\Services\FilamentMenuLoader;
use TomatoPHP\FilamentTranslations\FilamentTranslationsSwitcherPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'primary' => Color::Rose,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->favicon(asset('favicon.ico'))
            ->brandLogo(asset('tomato.png'))
            ->brandLogoHeight('80px')
            ->font(
                'IBM Plex Sans Arabic',
                provider: GoogleFontProvider::class,
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
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
            ->databaseNotifications()
            ->plugin(\TomatoPHP\FilamentUsers\FilamentUsersPlugin::make())
            ->plugin(\TomatoPHP\FilamentTranslations\FilamentTranslationsPlugin::make()
                ->allowGPTScan()
                ->allowClearTranslations()
                ->allowCreate())
            ->plugin(FilamentTranslationsSwitcherPlugin::make())
            ->plugin(\TomatoPHP\FilamentMenus\FilamentMenusPlugin::make())
            ->plugin(\TomatoPHP\FilamentSettingsHub\FilamentSettingsHubPlugin::make())
            ->plugin(\TomatoPHP\FilamentBrowser\FilamentBrowserPlugin::make())
            ->plugin(\TomatoPHP\FilamentArtisan\FilamentArtisanPlugin::make())
            ->plugin(\TomatoPHP\FilamentPlugins\FilamentPluginsPlugin::make())
            ->plugin(\TomatoPHP\FilamentTypes\FilamentTypesPlugin::make())
            ->plugin(
                \TomatoPHP\FilamentCms\FilamentCMSPlugin::make()
                    ->allowBehanceImport()
                    ->allowYoutubeImport()
                    ->useThemeManager()
                    ->usePageBuilder()
            )
            ->plugin(\TomatoPHP\FilamentWallet\FilamentWalletPlugin::make()->useAccounts())
            ->plugin(
                \TomatoPHP\FilamentAlerts\FilamentAlertsPlugin::make()
                    ->useSettingsHub()
                    ->useFCM()
            )
            ->plugin(\TomatoPHP\FilamentLocations\FilamentLocationsPlugin::make())
            ->plugin(
                \TomatoPHP\FilamentAccounts\FilamentAccountsPlugin::make()
                    ->canLogin()
                    ->useAccountMeta()
                    ->canBlocked()
                    ->showAddressField()
                    ->showTypeField()
                    ->useRequests()
                    ->useContactUs()
                    ->useLoginBy()
                    ->useAvatar()
                    ->useTypes()
                    ->useTeams()
                    ->useLocations()
                    ->useNotifications()
                    ->useImpersonate()
                    ->useAPIs()
                    ->impersonateRedirect('/app')
            )
            ->plugin(\BezhanSalleh\FilamentShield\FilamentShieldPlugin::make())
            ->plugin(FilamentAPIPlugin::make())
            ->plugin(FilamentMediaManagerPlugin::make())
            ->plugin(\TomatoPHP\FilamentFcm\FilamentFcmPlugin::make());
    }
}
