<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\SetlistController;
use App\Orchid\Screens\MusicScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Features\UserImpersonation;
use Stancl\Tenancy\Middleware\CheckTenantForMaintenanceMode;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    // 'platform',
    InitializeTenancyByDomainOrSubdomain::class,
    PreventAccessFromCentralDomains::class,
    CheckTenantForMaintenanceMode::class,
])->group(function () {

    Route::get('/impersonate/{token}', function ($token) {
        return UserImpersonation::makeResponse($token);
    });

    Route::middleware('platform')->group(function () {
        Route::screen('/admin', PlatformScreen::class)
            ->name('platform.index')
            ->breadcrumbs(function (Trail $trail) {
                return $trail->push(__('Home'), route('platform.index'));
            });

        Route::screen('/admin/main', PlatformScreen::class)
            ->name('platform.main');

        Route::screen('/admin/profile', UserProfileScreen::class)
            ->name('platform.profile')
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push(__('Profile'), route('platform.profile')));

        Route::screen('/admin/music', MusicScreen::class)
            ->name('platform.music')
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push(__('Profile'), route('platform.profile')));
    });


    Route::middleware('guest')->group(function () {
        Route::get('/register', function () {
            return view('auth.register');
        })->name('register');

        Route::post('/register', [AuthController::class, 'register']);

        Route::get('/login', function () {
            return view('auth.login');
        })->name('login');

        Route::post('/login', [AuthController::class, 'login']);



        // Route::view('/index', '/new/index')->name('dashboard');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            return view('dashboard.dashboard');
        })->name('home');

        Route::get('/music/{music}', [MusicController::class, 'show'])->name('music.show');
        Route::get('/music_create', [MusicController::class, 'create'])->name('music_create');
        Route::post('/music_create', [MusicController::class, 'store']);
        Route::get('/musics', [MusicController::class, 'show_my'])->name('musics');
        Route::get('/musics_my', [MusicController::class, 'show_my'])->name('musics_my');
        Route::get('/musics_shared_with_me', [MusicController::class, 'show_shared_with_me'])->name('musics_shared');

        Route::get('/setlist/{setlist}', [SetlistController::class, 'show_single']);
        Route::get('/setlists', [SetlistController::class, 'show_my'])->name('setlists');
        Route::get('/setlists', [SetlistController::class, 'show_my'])->name('setlist_create');
        Route::post('/setlists', [SetlistController::class, 'show_my']);
        Route::get('/setlists_my', [SetlistController::class, 'show_my'])->name('setlists_my');
        Route::get('/setlists_shared_with_me', [SetlistController::class, 'show_shared_with_me'])->name('setlists_shared');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
