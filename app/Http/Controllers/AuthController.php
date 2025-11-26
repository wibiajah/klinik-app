<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function store(Request $request)
{
    $credentials = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email'],
        'coveruser' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:5000'],
        'password' => ['required', 'string', 'confirmed', 'min:8', 'max:255'],
    ]);

    // PENTING: Gunakan huruf kecil untuk role!
    $credentials['role'] = 'user';  // BUKAN 'User'
    $credentials['is_active'] = true; // Set aktif secara default
    $credentials['password'] = Hash::make($credentials['password']);

    if ($request->hasFile('coveruser')) {
        $credentials['coveruser'] = $request->file('coveruser')->store('coverusers');
    }

    $user = User::create($credentials);
    Auth::login($user);

    return redirect()->route('user.dashboard');
}

    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'name' => ['required'],
        'password' => ['required'],
    ]);

    // Cari user berdasarkan name
    $user = User::where('name', $credentials['name'])->first();
    
    // Cek apakah user ada dan password benar
    if ($user && Hash::check($credentials['password'], $user->password)) {
        
        // Cek apakah user aktif
        if (!$user->is_active) {
            return back()->withErrors([
                'name' => 'Akun tidak aktif. Hubungi administrator.',
            ])->onlyInput('name');
        }

        // Login user
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        // Redirect berdasarkan role (GUNAKAN HURUF KECIL!)
        if (in_array($user->role, ['superadmin', 'admin', 'karyawan'])) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    return back()->withErrors([
        'name' => 'Username atau password salah.',
    ])->onlyInput('name');
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
