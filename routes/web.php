<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Redirect after login — Breeze calls route('dashboard')
Route::get('/dashboard', function () {
    return auth()->user()->is_admin
        ? redirect()->route('admin.dashboard')
        : redirect()->route('public.my-events');
})->name('dashboard')->middleware('auth');

// Public routes
Route::get('/', function () {
    $events = App\Models\Event::withCount('registrations')->latest()->take(3)->get();
    return view('welcome', compact('events'));
})->name('home');

Route::get('/events', [PublicController::class, 'events'])->name('public.events');
Route::get('/events/{event}', [PublicController::class, 'showEvent'])->name('public.show-event');

// Auth required (peserta)
Route::middleware('auth')->group(function () {
    Route::get('/events/{event}/register', [PublicController::class, 'registerForm'])->name('public.register-form');
    Route::post('/events/{event}/register', [PublicController::class, 'registerStore'])->name('public.register-store');
    Route::get('/events/{event}/registration/{registration}/invoice', [PublicController::class, 'invoice'])->name('public.invoice');
    Route::get('/my-events', [PublicController::class, 'myEvents'])->name('public.my-events');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $events = App\Models\Event::withCount('registrations')->latest()->get();
        $totalPeserta = App\Models\Registration::count();
        return view('dashboard', compact('events', 'totalPeserta'));
    })->name('dashboard');
    Route::resource('events', EventController::class);

    // Master Data — Event Types
    Route::get('/event-types', [MasterDataController::class, 'eventTypes'])->name('event-types.index');
    Route::get('/event-types/create', [MasterDataController::class, 'eventTypesCreate'])->name('event-types.create');
    Route::post('/event-types', [MasterDataController::class, 'eventTypesStore'])->name('event-types.store');
    Route::get('/event-types/{eventType}/edit', [MasterDataController::class, 'eventTypesEdit'])->name('event-types.edit');
    Route::put('/event-types/{eventType}', [MasterDataController::class, 'eventTypesUpdate'])->name('event-types.update');
    Route::delete('/event-types/{eventType}', [MasterDataController::class, 'eventTypesDestroy'])->name('event-types.destroy');

    // Master Data — Cities
    Route::get('/cities', [MasterDataController::class, 'cities'])->name('cities.index');
    Route::get('/cities/create', [MasterDataController::class, 'citiesCreate'])->name('cities.create');
    Route::post('/cities', [MasterDataController::class, 'citiesStore'])->name('cities.store');
    Route::get('/cities/{city}/edit', [MasterDataController::class, 'citiesEdit'])->name('cities.edit');
    Route::put('/cities/{city}', [MasterDataController::class, 'citiesUpdate'])->name('cities.update');
    Route::delete('/cities/{city}', [MasterDataController::class, 'citiesDestroy'])->name('cities.destroy');
});

require __DIR__.'/auth.php';
