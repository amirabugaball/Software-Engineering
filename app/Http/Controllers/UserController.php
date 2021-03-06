<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loadLogin()
    {
        return view('login');
    }

    public function loadHome()
    {
        return view('index');
    }

    public function loadAdmin()
    {
        return view('admin');
    }

    public function loadSignup()
    {
        return view('signup');
    }

    public function authenticate(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = request('username');
        $password = request('password');
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            if ($username == "Admin") {
                return redirect('/admin')->with('loginmessage', 'Welcome ' . $username . '!');
            } else {
                return redirect('/')->with('loginmessage', 'Welcome ' . $username . '!');
            }
        } else {
            return redirect('/login')->with('loginmessage', 'Incorrect username or password');
        }
    }

    public function submitUser(Request $request)
    {
        request()->validate([
            'username' => 'required|unique:users|min:4',
            'password' => 'required|min:6',
            'phone_number' => 'required|regex:/(01)[0-9]{9}/|size:11',
        ]);


        $username = request('username');
        $password = Hash::make(request('password'));
        $phone = request('phone_number');

        $user = User::create([
            'username' => $username,
            'password' => $password,
            'phone_number' => $phone
        ]);
        Auth::login($user);
        if (Auth::check()) {
            return redirect('/')->with('signmessage', 'Success, Welcome ' . $username . '!');
        } else {
            return redirect('/signup')->with('signmessage', 'Error.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
