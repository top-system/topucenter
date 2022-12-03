<?php

namespace TopSystem\UCenter\Http\Controllers\Api;


use Illuminate\Support\Facades\Validator;
use TopSystem\UCenter\Http\Controllers\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use TopSystem\UCenter\Http\Controllers\BaseController;
use TopSystem\UCenter\Responses\JsonResponse;

class AuthController extends BaseController {

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool|\Illuminate\Support\MessageBag
     */
    protected function validateLogin(Request $request)
    {
        $messages = [
            'account.required' => 'Email or username cannot be empty',
            'email.exists' => 'Email or username already registered',
            'username.exists' => 'Username is already registered',
            'password.required' => 'Password cannot be empty',
        ];

        $rules = [
            'account' => 'required|string',
            'password' => 'required|string',
            'email' => 'string|exists:users',
            'username' => 'string|exists:users',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return $validator->errors();
        }else{
            return false;
        }
    }

    public function login(Request $request){

        $credentials = $request->only($this->username(), 'password');
        if (($errors = $this->validateLogin($request))){
            return response()->json((new JsonResponse())->fail($errors), Response::HTTP_UNAUTHORIZED);
        }

        if (!Auth::attempt($credentials)) {
            return response()->json(new JsonResponse([], 'login error'), Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();
        if ($user->status == 1){
            return response()->json(new JsonResponse([], 'account disabled'), Response::HTTP_UNAUTHORIZED);
        }

        $user->last_login_ip = $request->ip();
        $user->save();
        return response()->json(new JsonResponse(new UserResource($user)), Response::HTTP_OK);
    }



    public function logout(Request $request)
    {
        $this->guard()->logout();
        return response()->json((new JsonResponse())->success([]), Response::HTTP_OK);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        $login = request()->input('account');
        if (check_mobile($login)){
            request()->merge(['mobile' => $login]);
            return 'mobile';
        }

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);

        return $field;
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

}