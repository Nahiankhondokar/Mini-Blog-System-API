<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password,
        ]);

        return $this->sendApiResponse($user, 'User register successfully.');
    }
   
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $response['user'] = $user;
            $response['token'] =  $user->createToken('token')->plainTextToken; 
   
            return $this->sendApiResponse($response, 'User login successfully.');
        }else { 
            return $this->sendApiError('Unauthorised', ['error'=>'Unauthorised']);
        } 
    }
}
