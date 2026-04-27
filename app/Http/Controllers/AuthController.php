<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showAuth()
    {
        return view('welcome');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function uploadProfileImage(Request $request)
    {
        try {
            $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $user = Auth::user();
            
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                
                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Store image in public/profiles directory
                $path = $image->storeAs('profiles', $filename, 'public');
                
                // Delete old profile image if exists
                if ($user->avatar && $user->avatar !== 'default.png') {
                    $oldPath = public_path('storage/' . $user->avatar);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                
                // Update user avatar
                $user->avatar = $path;
                $user->save();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Profile image updated successfully',
                    'image_url' => asset('storage/' . $path)
                ]);
            }
            
            return response()->json(['success' => false, 'message' => 'No image uploaded'], 400);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Error uploading image: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'bio' => 'nullable|string|max:500',
                'phone' => 'nullable|string|max:20'
            ]);

            $user = Auth::user();
            
            $user->name = $request->name;
            $user->bio = $request->bio;
            $user->phone = $request->phone;
            $user->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'user' => $user
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating profile: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getProfile()
    {
        try {
            $user = Auth::user();
            
            return response()->json([
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => $user->username,
                    'phone' => $user->phone,
                    'bio' => $user->bio,
                    'avatar' => $user->avatar ? asset('storage/' . $user->avatar) : null,
                    'online_status' => $user->online_status,
                    'last_seen' => $user->last_seen
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching profile: ' . $e->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        Auth::logout();
        
        // Check if request is AJAX
        if (request()->ajax()) {
            return response()->json(['redirect' => '/']);
        }
        
        // For non-AJAX requests (direct GET access), redirect to login
        return redirect('/login');
    }
}
