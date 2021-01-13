<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use App\Services\Gravatar;

use Auth;

class AuthController extends Controller
{
    public function register( Request $request )
    {

        $validator = Validator::make( $request->all(), [
            'name'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:users',
            'password'          => 'required|string|min:6',
            'confirm_password'  => 'required|same:password'
        ]);


        if( !$validator->fails() ){
//            $gravatar = new Gravatar( env('FRONTEND_URL').'/img/user/user.png', $request->get('email') );
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt( $request->get('password') ),
//                'avatar' => $gravatar->get()
            ]);

            $user->sendApiEmailVerificationNotification();

            return response()->json($user, 200 );
//            return response()->json('', 204);
        }
        
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    public function login( Request $request )
    {

        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ])) {
            return response()->json('User Successfully Logged In', 200 );
        } else {
            return response()->json([
                'error' => 'invalid_credentials'
            ], 403);
        }
    }

    public function logout( Request $request )
    {
        Auth::logout();
        return response()->json('', 204);
    }
}