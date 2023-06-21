<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use illuminate\Support\Fascades\Hash;
use Validator;

class AuthController extends Controller
{
    //
    public function Register(Request $request){
        $validateData = Validator::make($request->all(),[
            'name' => 'required|max:30',
            'email'=> 'email|required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if($validateData->fails()){
            return response()->json([
                'success' => false,
                'massage' => "ada kesalahan",
                "data" => $validateData->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['user'] = $user->name;

        return response()->json([
            'success' => True,
            'massage' => "Registrasi Berhasil",
            "data" => $success
        ]);



        // $validateData = $request->validate([
        //     'name' => 'required|max:30',
        //     'email'=> 'email|required|unique:users',
        //     'password' => 'required|confirmed'
        // ]);

        // $validateData['password'] = Hash::make($request->password);

        // $user = User::create($validateData);

        // $accessToken = $user->createToken('authToken')->accessToken;

        // return response(['user' => $user, 'access_token' => $accessToken], 201);
    }

    public function Login(Request $request){
        $validateData = $request->validate([
            'email'=> 'email|required',
            'password' => 'required|confirmed'
        ]);

        if(!auth()->attempt($validate)){
            return response(['message' => "User tidak terdaftar"], 400);
        }

        $accessToken = auth()->user()->ccreateToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken], 201);
    }
}
