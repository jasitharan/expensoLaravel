<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function getLogin(Request $request)
    {

        if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'financial_manager' )) {
            return redirect('/');
        }

        return view('login');
    }

    public  function doLogin(Request $request)
    {

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);


        if (Auth::attempt(['email' => $fields['email'], 'password' => $fields['password'], 'role' => ['admin','financial_manager']], $request->input('remember-me'))) {
            return redirect('/');
        } else {
            return redirect('login')->with('error', 'Please enter credentials correctly');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
