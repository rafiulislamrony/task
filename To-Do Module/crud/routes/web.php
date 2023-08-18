<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FriendsController;

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
    return view('index');
});

Route::post('/add/friends', [FriendsController::class, 'AddFriends'])->name('index');

// routes/web.php
Route::post('/add/friends', [FriendsController::class, 'AddFriends'])->name('add.friends');
Route::get('/edit/friends/{id}', [FriendsController::class, 'EditFriends'])->name('edit.friends');
Route::post('/update/friends/{id}', [FriendsController::class, 'UpdateFriends'])->name('update.friends');
Route::get('/update/friends/{id}', [FriendsController::class, 'UpdateFriends'])->name('update.friends');
Route::get('/delete/friends/{id}', [FriendsController::class, 'DeleteFriends'])->name('delete.friend');

