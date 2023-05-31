<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    // return view('dashboard');
    return view('theme.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/stream', function () {
        return view('theme.stream');
    })->name('stream');

    Route::get('/cameras', [\App\Http\Controllers\CameraController::class,'index']);

    // create token for user
    Route::post('/tokens/create', function (Request $request) {
        $token = $request->user()->createToken('personal-access-token');
        return ['token' => $token->plainTextToken];
    });






});

require __DIR__ . '/auth.php';
