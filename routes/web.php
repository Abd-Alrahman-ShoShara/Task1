<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/tasks', function () {
    return view('tasks');
});
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::get('/tasks', function () {
    $tasks = auth()->user()->tasks()->with('categories')->get();
    return view('tasks.index', compact('tasks'));
})->middleware('auth')->name('tasks.index');


Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/tasks-page', function () {
    return view('tasks');
});
// عرض صفحة التسجيل
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// معالجة بيانات التسجيل
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');