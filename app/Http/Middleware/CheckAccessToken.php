<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PersonalAccessToken;
use App\Helpers\Token;

class CheckAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!$request->header('Authorization')){
            return response()->json([
            'status'=>false,
            'message'=>'Token Not Null',
            ], 401);
        }


        $token=Token::getUserToken($request);


        $accessToken = PersonalAccessToken::where('token', $token)->first();
        // dd($accessToken);
        if (!$accessToken  || !$accessToken->token == $token ) {
            return response()->json([
            'status'=>false,
            'message'=>'Token is Invalid',
            ], 401);
        }
        return $next($request);
    }
}
