<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
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
use TomatoPHP\FilamentUsers\Facades\FilamentUser;

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
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::BODY_START,
//            fn (): string => view('hooks', ['hook' => "BODY_START"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::BODY_END,
//            fn (): string => view('hooks', ['hook' => "BODY_END"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
//            fn (): string => view('hooks', ['hook' => "AUTH_LOGIN_FORM_AFTER"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
//            fn (): string => view('hooks', ['hook' => "AUTH_LOGIN_FORM_BEFORE"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::AUTH_PASSWORD_RESET_REQUEST_FORM_AFTER,
//            fn (): string => view('hooks', ['hook' => "AUTH_PASSWORD_RESET_REQUEST_FORM_AFTER"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::AUTH_PASSWORD_RESET_REQUEST_FORM_BEFORE,
//            fn (): string => view('hooks', ['hook' => "AUTH_PASSWORD_RESET_REQUEST_FORM_BEFORE"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::AUTH_PASSWORD_RESET_RESET_FORM_AFTER,
//            fn (): string => view('hooks', ['hook' => "AUTH_PASSWORD_RESET_RESET_FORM_AFTER"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::AUTH_PASSWORD_RESET_RESET_FORM_BEFORE,
//            fn (): string => view('hooks', ['hook' => "AUTH_PASSWORD_RESET_RESET_FORM_BEFORE"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::AUTH_REGISTER_FORM_AFTER,
//            fn (): string => view('hooks', ['hook' => "AUTH_REGISTER_FORM_AFTER"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::AUTH_REGISTER_FORM_BEFORE,
//            fn (): string => view('hooks', ['hook' => "AUTH_REGISTER_FORM_BEFORE"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::CONTENT_END,
//            fn (): string => view('hooks', ['hook' => "CONTENT_END"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::CONTENT_START,
//            fn (): string => view('hooks', ['hook' => "CONTENT_START"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::FOOTER,
//            fn (): string => view('hooks', ['hook' => "FOOTER"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::GLOBAL_SEARCH_AFTER,
//            fn (): string => view('hooks', ['hook' => "GLOBAL_SEARCH_AFTER"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::GLOBAL_SEARCH_BEFORE,
//            fn (): string => view('hooks', ['hook' => "GLOBAL_SEARCH_BEFORE"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::GLOBAL_SEARCH_START,
//            fn (): string => view('hooks', ['hook' => "GLOBAL_SEARCH_START"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::GLOBAL_SEARCH_END,
//            fn (): string => view('hooks', ['hook' => "GLOBAL_SEARCH_END"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::HEAD_START,
//            fn (): string => view('hooks', ['hook' => "HEAD_START"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::HEAD_END,
//            fn (): string => view('hooks', ['hook' => "HEAD_END"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::PAGE_START,
//            fn (): string => view('hooks', ['hook' => "PAGE_START"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::PAGE_END,
//            fn (): string => view('hooks', ['hook' => "PAGE_END"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::PAGE_FOOTER_WIDGETS_AFTER,
//            fn (): string => view('hooks', ['hook' => "PAGE_FOOTER_WIDGETS_AFTER"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::PAGE_FOOTER_WIDGETS_BEFORE,
//            fn (): string => view('hooks', ['hook' => "PAGE_FOOTER_WIDGETS_BEFORE"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::PAGE_HEADER_ACTIONS_AFTER,
//            fn (): string => view('hooks', ['hook' => "PAGE_HEADER_ACTIONS_AFTER"])->render(),
//        );
//
//        FilamentView::registerRenderHook(
//            PanelsRenderHook::PAGE_HEADER_ACTIONS_BEFORE,
//            fn (): string => view('hooks', ['hook' => "PAGE_HEADER_ACTIONS_BEFORE"])->render(),
//        );
    }
}
