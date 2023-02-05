<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\Auth\RegisterController\RegisterRequest;
use App\Models\User;
use App\Services\API\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return BaseService::sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

            return BaseService::sendResponse($success, 'User login successfully.');
        } else {
            return BaseService::sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}
