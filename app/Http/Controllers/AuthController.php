<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function profile()
    {
        $users = User::all();
        return view('user.profile.index', compact('users'));
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|mimes:jpg,jpeg,png,svg,webp|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $namaFile = uniqid() . "-avatar" . $avatar->getClientOriginalExtension();
            $path = $avatar->storeAs("avatar", $namaFile, "public");
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile berhasil diupdate');
    }

    // Register User
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // langsung login setelah register
        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', 'Registrasi berhasil!');
    }

    // Login User
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on role
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.index')->with('success', 'Login sukses!');
            }

            return redirect()->route('user.dashboard')->with('success', 'Login sukses!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    // Logout User
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout sukses');
    }
}
