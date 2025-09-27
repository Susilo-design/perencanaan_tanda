<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
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

        return redirect()->route('projects.index')->with('success', 'Registrasi berhasil!');
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


            return redirect()->route('projects.index')->with('success', 'Login sukses!');
        }

        return response()->json([
            'message' => 'Email atau password salah',
        ], 401);
    }

    // Logout User
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout sukses',
        ]);
    }

    public function index()
    {

        $project = Project::all();

        return view('user.dashboard', compact('project'));
    }
}
