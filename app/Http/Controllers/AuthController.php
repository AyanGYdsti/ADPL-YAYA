<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function authRegister(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])->first();

        if ($user) {
            return back()->with('error', 'Email sudah terdaftar');
        }

        try {
            User::create($data);

            return back()->with('success', 'Berhasil mendaftar');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal registrasi akun');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
