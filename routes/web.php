<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\med;
use App\Http\Controllers\AuthLogout;
use Illuminate\Support\Facades\Auth;
Route::view('/', 'welcome');




Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->is_admin == 0) {
            return redirect()->route('admindashboard');
        }

        else {
             return redirect()->route('meddashboard');
        }


    })->name('dashboard');
});


Route::prefix('admin')->middleware(['auth', admin::class])->group(function () {
    Route::get('/Admindashboard', function () {
        return view('admin.indexx');
    })->name('admindashboard');


   Route::get('/admin.patients', function () {
        return view('admin.patients');
    })->name('admin.patients');

       Route::get('/admin.users', function () {
        return view('admin.users');
    })->name('admin.users');

       Route::get('/admin.refer', function () {
        return view('admin.refer');
    })->name('admin.refer');

   Route::get('/admin.reports', function () {
        return view('admin.reports');
    })->name('admin.reports');


});


Route::prefix('med')->middleware(['auth', med::class])->group(function () {
    Route::get('/meddashboard', function () {
        return view('med.index');
    })->name('meddashboard');





});


Route::post('/logout', [AuthLogout::class, 'logout'])->name('logouts');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
