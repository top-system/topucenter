<?php

namespace TopSystem\UCenter\Http\Controllers\Api;


use TopSystem\UCenter\Http\Controllers\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use TopSystem\UCenter\Http\Controllers\BaseController;
use TopSystem\UCenter\Responses\JsonResponse;

class AuthController extends BaseController {

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json(new JsonResponse([], 'login_error'), Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();

        return response()->json(new JsonResponse(new UserResource($user)), Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return response()->json((new JsonResponse())->success([]), Response::HTTP_OK);
    }


}