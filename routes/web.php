<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleSocialiteController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Auth\LoginController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);
Route::get('create-template', [EmailController::class, 'createTemplate'])->name('create.template');
Route::post('create-template', [EmailController::class, 'storeTemplate'])->name('store.template');

// Route::get('login/github', [LoginController::class, 'redirectToProvider']);
// Route::get('login/github/callback', [LoginController::class, 'handleProviderCallback']);


Route::get('login/github', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/github/callback', function () {
    try {
        $socialiteUser = Socialite::driver('github')->user();
    } catch(\Exception $e) {
        return redirect('/login');
    }
    $user = \App\Models\User::where([
        'provider' => 'github',
        'provider_id' => $socialiteUser->getId()
    ])->first();

    if(!$user) {
        $user = User::create([
            'name' => $socialiteUser->getName() ?? 'github',
            'email' => $socialiteUser->getEmail(),
            'provider' => 'github',
            'provider_id' => $socialiteUser->getId(),
            'email_verified_at' => now()

        ]);
    }
    \Illuminate\Support\Facades\Auth::login($user);
    return redirect()->route('dashboard');
    // return redirect('/');
    // dd($socialiteUser->getName(), $socialiteUser->getEmail(), $socialiteUser->getId());
    // $user->token
});