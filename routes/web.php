<?php

use App\Livewire\{
    Home,
    SignIn,
    SignUp
};
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/logout', [Home::class,'logout'])->name('logout');

Route::prefix('/user')->group(function(){
    Route::get('/signin', SignIn::class)->name('user.signin');
    Route::get('/signup', SignUp::class)->name('user.signup');
});
