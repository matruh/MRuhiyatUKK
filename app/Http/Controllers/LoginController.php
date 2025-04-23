<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:1',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('databuku');
                case 'user':
                    return redirect()->route('dashboard');
                case 'petugas':
                    return redirect()->route('databuku');
                default:
                    return redirect()->route('login'); // Sesuaikan dengan rute default
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Process the registration form submission.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'alamat' => 'required|string|max:255',
            'password' => 'required|string|min:1|confirmed',
            'role' => 'required|in:admin,user,petugas',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            // 'alamat' => $validated['alamat'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        Auth::login($user);

        // Redirect berdasarkan peran pengguna
        switch ($user->role) {
            case 'admin':
                return redirect()->route('databuku');
            case 'user':
                return redirect()->route('dashboard');
            case 'petugas':
                return redirect()->route('databuku');
            default:
                return redirect()->route('login'); // Sesuaikan dengan rute default
        }
    }
}
