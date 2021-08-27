<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        return view('login');
    }
    /**
     * Login function
     */
    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:32',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->to('admin');
        }
        return redirect()->back()->withErrors(['Email or password is incorrect!'], 'login');
    }

    /**
     * Logout function
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->to('login');
    }
}
