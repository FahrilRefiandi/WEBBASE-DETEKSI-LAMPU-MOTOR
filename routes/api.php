<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Helpers\Token;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/store-video', function (Request $request) {

    // dd($request->video);
    // $request->validate([
    //     'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
    // ]);

    $path = $request->file('video')->store('public/asset');

    return response()->json(
        [
            'status' => true,
            'message' => 'Video uploaded successfully',
            'data' => [
                'name' => basename($path),
                'video' => url(Storage::url($path)),
                'size' => Storage::size($path) . ' bytes',
            ],
        ],
        200,
    );
});


Route::middleware('token')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json(
            [
                'status' => true,
                'personal_access_token' => Token::getUserToken($request),
                'data' => Token::getUserInfo($request),
            ],
            200,
        );
    });

    Route::get('/cameras',[\App\Http\Controllers\CameraController::class,'show'])->name('api.camera.show');
    Route::post('/cameras',[\App\Http\Controllers\CameraController::class,'store'])->name('api.camera.store');



    Route::get('/video', function (Request $request) {
        $data = Storage::allFiles('public/asset');

        for ($i = 0; $i < count($data); $i++) {
            $r[$i]['name'] = basename($data[$i]);
            $r[$i]['video'] = url(Storage::url($data[$i]));
            $r[$i]['size'] = Storage::size($data[$i]) . ' bytes';
        }

        return response()->json(
            [
                'status' => true,
                'personal_access_token' => Token::getUserToken($request),
                'data' => $r,
            ],
            200,
        );
    });
});


Route::post('/stream', function (Request $request) {

    return response()->json(
        [
            'status' => true,
            // 'personal_access_token' => Token::getUserToken($request),
            'data' => $request,
        ],
        200,
    );
});

// Route::middleware('api')->group(function () {
//     Route::get('/token', function (Request $request) {
//         dd(auth()->user());
//         $data = PersonalAccessToken::where('tokenable_id', auth()->user()->id)->get();
//         return response()->json(
//             [
//                 'status' => true,
//                 'personal_access_token' => $data,
//             ],
//             200,
//         );
//     });
// });


// Route::middleware('auth:api')->get('/usera', function (Request $request) {
//     return $request;
// });
