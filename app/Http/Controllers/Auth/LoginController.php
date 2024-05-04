<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function loginForm() {
        return view("auth.login");
    }

    public function login(LoginRequest $request) {
        $credentials = $request->validated();
        if(auth()->attempt($credentials)) {
            $request->session()->regenerate();
            auth()->user()->update(['status' => 'online']);
            return redirect()->route('user.showUserHeader');
        }
        return redirect()->route("login")->withErrors("Email or Password is incorrect!");
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->user()->update(['status' => 'offline']);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }
}
