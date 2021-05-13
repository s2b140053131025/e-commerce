<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    
    public $loginAfterSignUp = true;

    public function register(Request $request)
    {
      $user = User::create([
        'firstName' => $request->firstName,
        'lastName' => $request->lastName,
        'email' => $request->email,
        'password' => bcrypt($request->password),
      ]);

      $token = auth()->login($user);

      return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
      $credentials = $request->only(['email', 'password']);

      if (!$token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }

      //return $this->respondWithToken($token);
      return response(['credentials'=>$credentials ,'access_token'=>$token]);
      //return $credentials;

    }
    public function getAuthUser(Request $request)
    {
        $user = response()->json(auth()->user());
        if($user){
          $userdata = User::select( 'id' ,'firstname', 'lastname', 'email')->get();

        }
            
        //return  response()->json(['userdata'=>$userdata]);
        return $userdata;
        
      
    }
    public function logout()
    {
        auth()->logout();
        return response()->json(['message'=>'Successfully logged out']);
    }
    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        //'expires_in' => auth()->factory()->getTTL() * 60
        'expires_in' => auth('api')->factory()->getTTL() * 60

      ]);
    }

}
