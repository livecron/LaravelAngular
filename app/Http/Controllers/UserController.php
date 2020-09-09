<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller
{
    public function register(RegisterRequest $request) {

        $model = new User();
        $model->nombre = $request->get('nombre');
        $model->apellidos = $request->get('apellidos');
        $model->email = $request->get('email');
        $model->password =  Hash::make($request->get('password'));
        $model->rol = 'admin';
        if ( $model->save()) {
            return response()->json(['data'=> $model]);
        } else {
            return response()->json(['data'=> null, 'state' => false]);
        }
    }
    public function login(Request $request) {
        $credenciales = $request->only('email','password');
        try {
            if (!$token = JWTAuth::attempt($credenciales)) {
                return response()->json(['error' => 'credenciales invalidos'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'error al iniciar session'], 500);
        }

        return response()->json(compact('token'));
    }
    public function logout() {
        $token = JWTAuth::getToken();
        try {
             JWTAuth::invalidate($token);
             return response()->json(['state' => true, 'message' => 'se cerro correctament la session']);
        }catch (JWTException $e) {
            return response()->json(['state' => false, 'message' => 'error al logout']);
        }
    }
}
