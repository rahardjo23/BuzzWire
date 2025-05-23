<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Article; // Tambahkan import untuk model Article

class ProfileController extends Controller
{
    // Hapus constructor dengan middleware
    // Middleware auth sudah diatur di route web.php
    
    public function show()
    {
        $user = Auth::user();
        
        // Ambil artikel yang dipublikasikan oleh user yang sedang login
        $publishedArticles = Article::where('user_id', $user->id)
                                ->where('is_published', 1)
                                ->orderBy('publish_time', 'desc')
                                ->get();
        
        // Ambil draft artikel (artikel yang belum dipublikasikan)
        $drafts = Article::where('user_id', $user->id)
                      ->where('is_published', 0)
                      ->orderBy('updated_at', 'desc')
                      ->get();
        
        // Debug: log jumlah artikel untuk membantu troubleshooting
        \Log::info('User ID: ' . $user->id);
        \Log::info('Published Articles Count: ' . $publishedArticles->count());
        \Log::info('Drafts Count: ' . $drafts->count());
        
        return view('profile', compact('user', 'publishedArticles', 'drafts'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($request->hasFile('profile_image')) {
            // Hapus gambar lama jika ada
            if ($user->profile_image && $user->profile_image != 'profile_images/default.jpg') {
                Storage::delete('public/' . $user->profile_image);
            }
            
            // Upload gambar baru
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }
        
        $user->name = $validated['name'];
        $user->bio = $validated['bio'];
        $user->email = $validated['email'];
        
        $user->save();
        
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        
        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->route('profile')->with('success', 'Password updated successfully!');
    }
    
    /**
     * Menampilkan semua artikel yang dipublikasikan oleh user
     */
    public function articles()
    {
        $user = Auth::user();
        
        $publishedArticles = Article::where('user_id', $user->id)
                                ->where('is_published', 1)
                                ->orderBy('publish_time', 'desc')
                                ->paginate(10);
        
        return view('profile.articles', compact('user', 'publishedArticles'));
    }
    
    /**
     * Menampilkan semua draft artikel user
     */
    public function drafts()
    {
        $user = Auth::user();
        
        $drafts = Article::where('user_id', $user->id)
                      ->where('is_published', 0)
                      ->orderBy('updated_at', 'desc')
                      ->paginate(10);
        
        return view('profile.drafts', compact('user', 'drafts'));
    }
}