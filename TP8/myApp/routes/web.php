<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemoController;
use App\Http\Middleware\AuthenticateMyUser;

Route::get('/', function() {
    return view('signin');
});
Route::get('signin', function() {
    return view('signin');
})->name('view_Signin');
Route::get('signup', function() {
    return view('signup');
})->name('view_Signup');
Route::get('memo', function() {
    return view('formmemo');
})->name('view_formmemo');

Route::post('authenticate', [UserController::class, 'connect'])->name('user_Authenticate');
Route::get('delete', [UserController::class, 'delete'])->name('user_Delete');
Route::post('create', [UserController::class, 'create'])->name('user_Create');
Route::post('updatePassword', [UserController::class, 'updatePassword'])->name('user_UpdatePassword');
Route::get('signout', [UserController::class, 'disconnect'])->name('user_Signout');

Route::post('add', [MemoController::class, 'add'])->name('memo_add');
Route::get('show', [MemoController::class, 'show'])->name('memo_show');


Route::prefix('admin')->middleware([AuthenticateMyUser::class])->group(
    function(){
        Route::get('account', function() {
            return view('account');
        })->name('view_Account');
        Route::get('formpassword', function() { 
            return view('formpassword');
        })->name('view_Formpassword');
    }
);