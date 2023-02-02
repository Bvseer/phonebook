<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Services\API\BaseService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterController\RegisterRequest;

use Validator;
   
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