<?php

namespace TopSystem\UCenter\Http\Controllers\Api;

use TopSystem\UCenter\Http\Controllers\Resources\UserResource;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use TopSystem\UCenter\Http\Controllers\BaseController;
use TopSystem\UCenter\Models\User;

class RegisterController extends BaseController
{

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $error = $this->validator($request->all())->errors()->first();
        if ($error){
            return response()->json(new \TopSystem\UCenter\Responses\JsonResponse([],$error), Response::HTTP_FORBIDDEN);
        }
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return response()->json(new \TopSystem\UCenter\Responses\JsonResponse(new UserResource($user)), Response::HTTP_OK);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) : \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'  => $data['username'],
            'username' => $data['username'],
            'email' => $data['email'],
            'role_id' => 2,
            'password' => Hash::make($data['password']),
        ]);
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
