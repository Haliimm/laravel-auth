<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('Auth.Register.index', [
            'title' => 'Register',
        ]);
    }
    public function store(Request $request) {
        $validateData = $request->validate([
            'name' => 'required|max:225',
            'phone' => 'max:225',
            'address' => 'max:225',
            'email' => 'required|min:3|max:225|unique:users',
            'password' => 'required|min:5|max:10'
        ]);

        // $validateData['password'] = bcrypt($validateData['password']);
        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        $request->session()->flash('success', 'Registration Successfully, Please Login!');
        
        return redirect('/login');
    }
}