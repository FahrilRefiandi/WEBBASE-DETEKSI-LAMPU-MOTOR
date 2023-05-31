<?php

namespace App\Helpers;

use App\Models\PersonalAccessToken;

class Token {

    public static function trim($token) {
        $token=substr($token, 7);
        return (isset($token) ? $token : '');
    }

    public static function getUserToken($request) {
        $token = $request->header('Authorization');
        $token = self::trim($token);
        return $token;
    }

    public static function getUserInfo($request) {
        $token = self::getUserToken($request);
        $user = PersonalAccessToken::where('token', $token)->first()->user;
        $user->avatar = Avatar::getAvatar($user->name);
        return $user;
    }

}
