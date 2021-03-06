<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            if(!auth()->user()->status){
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return back()->withInput()->withErrors([
                    'email' => 'Votre compte n\'est plus actif'
                ]);
            }

            return redirect()->intended('dashboard');
        }

        return back()->withInput()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
