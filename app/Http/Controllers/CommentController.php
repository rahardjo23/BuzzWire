<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Article $article)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to comment.');
        }

        // Validasi input
        $request->validate([
            'content' => 'required|string|min:5|max:1000',
        ], [
            'content.required' => 'Comment content is required.',
            'content.min' => 'Comment must be at least 5 characters long.',
            'content.max' => 'Comment cannot exceed 1000 characters.',
        ]);

        // Buat komentar baru
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->article_id = $article->id;
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->back()->with('success', 'Your comment has been posted successfully!');
    }

    /**
     * Get comment data for editing (AJAX)
     */
    public function edit(Comment $comment)
    {
        // Pastikan user hanya bisa edit comment mereka sendiri
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'id' => $comment->id,
            'content' => $comment->content
        ]);
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        // Pastikan user hanya bisa update comment mereka sendiri
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You can only edit your own comments.');
        }

        // Validasi input
        $request->validate([
            'content' => 'required|string|min:5|max:1000',
        ], [
            'content.required' => 'Comment content is required.',
            'content.min' => 'Comment must be at least 5 characters long.',
            'content.max' => 'Comment cannot exceed 1000 characters.',
        ]);

        // Update komentar
        $comment->update([
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', 'Comment updated successfully!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        // Pastikan user hanya bisa hapus comment mereka sendiri
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You can only delete your own comments.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}