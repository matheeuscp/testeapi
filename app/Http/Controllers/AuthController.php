<?php
# app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Hash;
use Response;

class AuthController extends Controller
{
    public function authenticate(Request $request) {
      $errors1 = [];
      $errors2 = [];
      $error = [];
      // Get only email and password from request
      $credentials = $request->only('email', 'password');
      if(is_null($credentials['email'])){
        $errors1['message'] = 'email can not be null';
        $errors1['field'] = 'email';      
      }
      if(is_null($credentials['password'])){
        $errors2['message'] = 'password can not be null';
        $errors2['field'] = 'password';
      }
      array_push($error, $errors1);
      array_push($error, $errors2);
      // Get user by email
      $user = User::where('email', $credentials['email'])->first();
      
      // Validate user
      if(!$user) {
        return Response::json(['response'=>'Usuário não encontrado', 'error' =>  $error], 401);
      }
      // Validate Password
      if (!Hash::check($credentials['password'], $user->password)) {
          return Response::json(['response'=>'Usuário não encontrado', 'error' => $error], 401);
      }

      // Generate Token
      $token = JWTAuth::fromUser($user);

      // Get expiration time
      $objectToken = JWTAuth::setToken($token);
      $expiration  = JWTAuth::decode($objectToken->getToken())->get('exp');

      return response()->json([
        'access_token' => $token,
        'token_type'   => 'bearer',
        'user' => $user,
        'expires_in'   => JWTAuth::decode($objectToken->getToken())->get('exp')
      ]);        
    }
}