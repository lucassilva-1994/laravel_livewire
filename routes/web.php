<?php

use App\Livewire\{
    Home,
    Logout,
    SignIn,
    SignUp,
    User
};
use App\Livewire\Post\PostEdit;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/logout', Logout::class)->name('logout');

Route::get('/users', User::class)->name('users');
Route::prefix('/user')->group(function(){
    Route::get('/signin', SignIn::class)->name('user.signin');
    Route::get('/signup', SignUp::class)->name('user.signup');
});

Route::get('/post/edit/{id}', PostEdit::class)->name('post.edit');
