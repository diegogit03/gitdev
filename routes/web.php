<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Livewire\CreateRepository;
use App\Livewire\Repositories;
use App\Livewire\RepositoryBlobDetails;
use App\Livewire\RepositoryDetails;
use App\Livewire\RepositoryHistory;
use hollodotme\FastCGI\Client;
use hollodotme\FastCGI\SocketConnections\UnixDomainSocket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');

    Route::get('/', Repositories::class)->name('home');
    Route::get('/create', CreateRepository::class)->name('repositories.create');
    Route::get('/{repository}/tree/{tree?}', RepositoryDetails::class)->name('repositories.details')->where('tree', '.*');
    Route::get('/{repository}/history', RepositoryHistory::class)->name('repositories.history');
    Route::get('/{repository}/blob/{blobName}', RepositoryBlobDetails::class)->name('repositories.blob')->where('blobName', '.*');
});
