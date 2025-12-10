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

    public function editProfile()
    {
        return view('user.profile.edit');
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $extension = strtolower($avatar->getClientOriginalExtension());
            $namaFile = uniqid() . "-avatar." . $extension;
            $path = $avatar->storeAs("avatar", $namaFile, "public");
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile berhasil diupdate');
    }


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

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.index')->with('success', 'Login sukses!');
            }

            return redirect()->route('user.dashboard')->with('success', 'Login sukses!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout sukses');
    }
}
