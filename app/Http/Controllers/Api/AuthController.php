<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserApiResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
        ]);

        return new UserApiResource( $user );

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

          $email = $request->input('email');

           $credentials = $request->only('email' , 'password');

        if ( Auth::attempt( $credentials ) )
          {
             $user = User::where( 'email' , $email )->first();

             return new UserApiResource( $user );
          }

          $massige= [
              'error' => true,
              'message' => 'User Login Failed'
          ];
        return response($massige,401);
    }
}
