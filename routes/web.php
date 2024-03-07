<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PageListComponent;
use App\Http\Livewire\PageCreateOrUpdateComponent;
use App\Http\Livewire\User\PageComponent as UserPageComponent;
use App\Http\Livewire\User\PageListComponent as UserPageListComponent;

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

// Default route
Route::get('/', function () {
    return redirect()->route('login');
});

// Admin routes
Route::prefix('admin')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // Page list
    Route::get('pages', PageListComponent::class)->name('pages');
    // Page create
    Route::get('page/create', PageCreateOrUpdateComponent::class)->name('page.create');
    // Page update
    Route::get('page/update/{id}', PageCreateOrUpdateComponent::class)->name('page.update');
});

// User routes
// Page list for users
Route::get('/page', UserPageListComponent::class)->name('page.list');
// Page details for users
Route::get('/page/{slug?}', UserPageComponent::class)->name('page.show')->where('slug', '(.*)');
