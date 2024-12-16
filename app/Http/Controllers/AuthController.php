<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('YourAppName')->plainTextToken;
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request) {

        $credentials=$request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('YourAppName')->plainTextToken;
            return response()->json(['token' => $token], 200);            
        }
        

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    


    public function user(Request $request)
    {
        return response()->json($request->user());
    }
    public function logout(Request $request)
{
    // Check if the user is authenticated
    if ($request->user()) {
        // Revoke all tokens for the authenticated user
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    // Return a 401 Unauthorized response if no user is authenticated
    return response()->json(['message' => 'No authenticated token found'], 401);
}

    
    

    

    

}
