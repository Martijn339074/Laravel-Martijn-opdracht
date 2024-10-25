<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name'  => ['required'],
            'email'      => ['required', 'email', 'unique:users'],
            'password'   => ['required', 'min:8']
        ]);

        $attributes['password'] = bcrypt($attributes['password']);
        
        $user = User::create($attributes);
        
        Auth::login($user);
        
        return redirect('/jobs');
    }
}