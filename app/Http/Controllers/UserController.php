<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required',
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/'); // Redirect on successful login
        }
    }

    public function logout(Request $request) {
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:50', Rule::unique('users', 'name')],
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required', 'min:6', 'max:20'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);

        auth()->login($user);
        return redirect('/');

        // User::create($incomingFields);

        // return "Hello from our controller!";
    }
}
