<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\PersonalAccessToken;
use App\Models\User;

Route::middleware('auth')->group(function () {
    Route::get('/token', function (Request $request) {
        $data = PersonalAccessToken::where('tokenable_id', $request->user()->id)->get();
        return response()->json(
            [
                'status' => true,
                'data' => $data,
            ],
            200,
        );
    });
});


// Route::middleware('auth:api')->get('/usera', function (Request $request) {
//     return $request;
// });
