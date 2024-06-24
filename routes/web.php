<?php

use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\TeamInvitationController;

Route::get('/', function () {
    $page = load_page('/');
    return view('welcome', compact('page'));
})->middleware(\TomatoPHP\FilamentTranslations\Http\Middleware\LanguageMiddleware::class);

Route::redirect('/login', '/app/login')->name('login');

Route::redirect('/register', '/app/register')->name('register');

Route::redirect('/dashboard', '/app')->name('dashboard');

Route::get('/team-invitations/{invitation}', [TeamInvitationController::class, 'accept'])
    ->middleware(['signed', 'verified', 'auth', AuthenticateSession::class])
    ->name('team-invitations.accept');
