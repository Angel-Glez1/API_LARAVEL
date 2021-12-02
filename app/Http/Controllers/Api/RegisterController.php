<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {

        return response()->json(['ok' => true, 'msg' => 'hola amigos']);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

        ]);

        $user = User::create($request->all());

        return response(['ok' => true, 'user' => $user], 200);
    }
}
