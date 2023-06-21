<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use illuminate\Support\Fascades\Hash;
use Validator;
use Auth;

class AuthController extends Controller
{
    //
    public function Register(Request $request){
        $validateData = Validator::make($request->all(),[
            'name' => 'required|max:30',
            'email'=> 'email|required|unique:users',
            'password' => 'required'
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
    }

    public function Login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;

            return response()->json([
                'success' => True,
                'massage' => "Login Berhasil",
                "data" => $success
            ]);
        } else {
            return response()->json([
                'success' => False,
                'massage' => "Cek email dan password lagi",
                "data" => $success
            ]);
        }
    }

    public function Logout(Request $request){
        $request->user()->currentToken->delete();
        return response()->json([
            'success' => True,
            'massage' => "Log Out Berhasil"
        ]);
    }
}
