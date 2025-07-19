<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Tambahkan log

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // ✅ Log saat user berhasil register
        Log::notice('User baru berhasil register', [
            'user_id' => $user->id,
            'email' => $user->email,
            'waktu' => now()->toDateTimeString()
        ]);

        return response()->json(['message' => 'User registered successfully']);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        // ✅ Log saat login
        Log::info('Login berhasil', [
            'user_id' => $user->id,
            'email' => $user->email,
            'waktu' => now()->toDateTimeString()
        ]);

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();

        // ✅ Log saat logout
        Log::warning('User logout', [
            'user_id' => $user->id,
            'email' => $user->email,
            'waktu' => now()->toDateTimeString()
        ]);

        return response()->json(['message' => 'Logged out successfully']);
    }
}
