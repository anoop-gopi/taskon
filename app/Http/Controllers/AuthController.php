<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

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
                'company_name' => 'nullable|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'company_name' => $validated['company_name'] ?? null,
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
     * Validate if the user session is still active
     */
    public function validateSession()
    {
        $user = auth()->user();
        
        if ($user) {
            return response()->json([
                'authenticated' => true,
                'user' => $user,
            ], 200);
        }
        
        return response()->json([
            'authenticated' => false,
            'user' => null,
        ], 200);
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

    /**
     * Redirect to Google OAuth provider
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user exists by email or google_id
            $user = User::where('email', $googleUser->getEmail())
                ->orWhere('google_id', $googleUser->getId())
                ->first();

            if ($user) {
                // Update google_id if it wasn't set
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
            } else {
                // Create new user with pending approval status
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(uniqid()), // Generate random password for OAuth users
                    'status_id' => 1, // Pending approval
                ]);
            }

            // Check if user is approved
            if ($user->status_id != 2) {
                $statusMessage = $user->status_id == 1 
                    ? 'Your account is pending approval. Please wait for admin approval.'
                    : 'Your account has been rejected. Please contact support.';
                
                return redirect()->route('public.home')->with('error', $statusMessage);
            }

            // Log the user in
            auth()->login($user, true);
            
            return redirect()->route('dashboard.home')->with('success', 'Signed in with Google successfully!');
        } catch (\Exception $e) {
            return redirect()->route('public.home')->with('error', 'Failed to sign in with Google: ' . $e->getMessage());
        }
    }

    /**
     * Redirect to Facebook OAuth provider
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle Facebook OAuth callback
     */
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            
            // Check if user exists by email or facebook_id
            $user = User::where('email', $facebookUser->getEmail())
                ->orWhere('facebook_id', $facebookUser->getId())
                ->first();

            if ($user) {
                // Update facebook_id if it wasn't set
                if (!$user->facebook_id) {
                    $user->update(['facebook_id' => $facebookUser->getId()]);
                }
            } else {
                // Create new user with pending approval status
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'facebook_id' => $facebookUser->getId(),
                    'password' => Hash::make(uniqid()), // Generate random password for OAuth users
                    'status_id' => 1, // Pending approval
                ]);
            }

            // Check if user is approved
            if ($user->status_id != 2) {
                $statusMessage = $user->status_id == 1 
                    ? 'Your account is pending approval. Please wait for admin approval.'
                    : 'Your account has been rejected. Please contact support.';
                
                return redirect()->route('public.home')->with('error', $statusMessage);
            }

            // Log the user in
            auth()->login($user, true);
            
            return redirect()->route('dashboard.home')->with('success', 'Signed in with Facebook successfully!');
        } catch (\Exception $e) {
            return redirect()->route('public.home')->with('error', 'Failed to sign in with Facebook: ' . $e->getMessage());
        }
    }
