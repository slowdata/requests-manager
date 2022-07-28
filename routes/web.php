<?php

use App\Models\App;
use App\Models\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'reqs' => Request::all()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/apps/{name?}', function ($name = null) {
    $aps = null;
    if ($name == 'short') {
        $apps  = App::where('active', true)->pluck('name', 'id');
    } else {
        $apps = App::where('active', true)->get();
    }
    return $apps;
});

// Inertia::share('apps',  App::where('active', true)->pluck('name'));

Route::get('/requests', function () {
    return Request::all();
});



require __DIR__ . '/auth.php';
