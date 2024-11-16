<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'content' => $request->content,
        ]);

        return redirect(route('posts.show', ['slug' => $comment->post->slug]))->with('flash', [
            'snackbar'      => [
                'message'   => 'Your comment has been added!',
                'type'      => 'success'
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the user is logged in
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'content' => 'required|string|max:500',
        ],[], [
            'content' => 'Content of the comment',
        ]);

        $comment->update(['content' => $request->content]);
        return redirect(route('posts.show', ['slug' => $comment->post->slug]))->with('flash', [
            'snackbar'      => [
                'message'   => 'Your comment has been updated!',
                'type'      => 'success'
            ]
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the user is logged in
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $comment->delete();

        return redirect(route('posts.show', ['slug' => $comment->post->slug]))->with('flash', [
            'snackbar'      => [
                'message'   => 'Your comment has been deleted!',
                'type'      => 'info'
            ]
        ]);
    }

}
