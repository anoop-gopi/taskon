<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle user signup
     */
    public function signup(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'status_id' => 1, // Pending approval
            ]);

            // Don't log the user in - they need admin approval first

            return response()->json([
                'success' => true,
                'message' => 'Account created successfully! Please wait for admin approval before logging in.',
                'user' => $user,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Handle user signin
     */
    public function signin(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            // Check if user exists
            $user = User::where('email', $validated['email'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password',
                ], 401);
            }

            // Check if user is approved
            if ($user->status_id != 2) {
                $statusMessage = $user->status_id == 1 
                    ? 'Your account is pending approval. Please wait for admin approval.'
                    : 'Your account has been rejected. Please contact support.';
                    
                return response()->json([
                    'success' => false,
                    'message' => $statusMessage,
                ], 403);
            }

            // Log the user in
            auth()->login($user);
            
            // Regenerate session for security
            request()->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Signed in successfully!',
                'user' => $user,
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        auth()->logout();
        
        // Invalidate the session
        $request->session()->invalidate();
        
        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully!',
        ], 200);
    }
}
