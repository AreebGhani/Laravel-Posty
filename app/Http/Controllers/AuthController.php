<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->only('remember'))) {
            return redirect()->intended('dashboard')->with('success', 'Login Successfully . . . !');
        }
        return back()->with('error', 'Login details are not valid.');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4'
        ]);
        $data = $request->all();
        $check = $this->create($data);
        if ($check) {
            return redirect()->intended('login')->with([
                'success' => 'Account Created Successfully . . . !',
                'useremail' => $data['email'],
                'userpassword' => $data['password'],
            ]);
        }
        return back();
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login')->with('error', 'You are logout.');
    }
}
