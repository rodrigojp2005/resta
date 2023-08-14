<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

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
    //return view('welcome');
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
     return view('dashboard');
     Route::get('/dashboard', function () {
        Route::get('/messages/{sender_id}/{recipient_id}', [MessageController::class, 'index']);
        Route::get('/messages/{message_id}', [MessageController::class, 'show']);
        Route::post('/messages', [MessageController::class, 'store']);
        Route::delete('/messages/{message_id}', [MessageController::class, 'destroy']);
          return view('dashboard');
      });
    //  Route::get('/messages/{sender_id}/{recipient_id}', [MessageController::class, 'index']);
    //  Route::get('/messages/{message_id}', [MessageController::class, 'show']);
    //  Route::post('/messages', [MessageController::class, 'store']);
    //  Route::delete('/messages/{message_id}', [MessageController::class, 'destroy']);
 })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth', 'verified'])->group(function () {
// //    Route::get('/dashboard', function () {
//         return view('dashboard');
// //    });

//     Route::get('/messages/{sender_id}/{recipient_id}', [MessageController::class, 'index']);
//     Route::get('/messages/{message_id}', [MessageController::class, 'show']);
//     Route::post('/messages', [MessageController::class, 'store']);
//     Route::delete('/messages/{message_id}', [MessageController::class, 'destroy']);
//     // Route::get('dashboard', function () {
//     //     return view('dashboard');
//     // });
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
