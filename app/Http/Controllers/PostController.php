<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function dashboard()
    {
        $posts = Post::all();
        return view('pages.posts', compact('posts'));
    }
    public function index () 
    {
        $defaultSortColumn = 'id';
        $defaultSortOrder = 'desc';
    
        // Sort by default if no specific order is chosen
        $orderBy = request('orderBy') ?? $defaultSortColumn;
        $order = request('order') ?? $defaultSortOrder;
    
        // Toggle order
        $order = ($order === 'desc') ? 'asc' : 'desc';
    
        // Get sorted posts with pagination
        $posts = Post::orderBy($orderBy, $order)->paginate(30);
        return view('posts.index', [
            'posts'         =>  $posts,
            'orderBy'       => $orderBy,
            'order'         => $order,
            'title'         => 'All Posts',
            'type'          => 'index',
            'edit_text'     => 'Edit',
            'trash_text'    => 'Trash',
            'next_title'    => 'Add new Post',
            'title_route'   => route('create'),
        ]);
    }
    public function create()
    {
        return view('posts.modify', [
            'post'          => new Post(),
            'title'         => 'New Post',
            'method'        => 'POST',
            'button'        => 'Create Post',
            'route'         => route('posts.store'),
        ]);
    }
    public function store(Request $request) 
    {
        // Validation rules
        $validated  = $request->validate([
            'title' => 'required|string|max:250|unique:posts,title',
        ]);

        // Create an automatic slug based on the title
        $slug       = Str::slug($request->title);
        $user_id    = auth()->id();
        $post = Post::create([
            'title'         => $request->title,
            'content'       => $request->content ?? '',
            'slug'          => $slug,
            'author'        => $user_id,
        ]);

        return redirect(route('posts.show', ['slug' => $post->slug]))->with('flash', [
            'snackbar'      => [
                'message'   => 'Your post has been created!',
                'type'      => 'success'
            ]
        ]);

    }
    public function edit($id) 
    {
        $post = Post::where('id', $id)->first();
        return view('posts.modify', [
            'post'          => $post,
            'title'         => 'Edit Post',
            'method'        => 'PUT',
            'button'        => 'Edit Post',
            'route'         => route('posts.update', $id),
        ]);

    }
    public function update($id, Request $request) 
    {
        $post = Post::where('id', $id)->first();

        // Validation rules
        $validated  = $request->validate([
            'title' => 'required|string|max:250|unique:posts,title,' . $post->id,
        ]);

        $post->update([
            'title'         => $request->title,
            'content'       => $request->content ?? '',
        ]);

        return redirect(route('posts.index'))->with('flash', [
            'snackbar'      => [
                'message'   => 'Your post has been updated successfully!',
                'type'      => 'success'
            ]
        ]);
    }
    public function show($slug) 
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('pages.singlePost', compact('post'));
    }
    public function trashed () 
    {
        $posts = Post::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(30);

        return view('posts.index', [
            'posts'         => $posts,
            'type'          => 'trash',
            'title'         => 'Trashed Posts',
            'edit_text'     => 'Restore',
            'trash_text'    => 'Force Delete',
            'orderBy'       => 'deleted_at',
            'order'         => 'desc',
    
        ]);
    }
    public function destroy($id)
    {
        Post::where('id', $id)->first()->delete();

        return redirect(route('posts.index'))->with('flash', [
            'snackbar'      => [
                'message'   => 'Post moved to trash!',
                'type'      => 'info'
            ]
        ]);
    }

    public function forceDelete($id)
    {
        Post::withTrashed()->Find($id)->forceDelete();

        return redirect(route('posts.index'))->with('flash', [
            'snackbar'      => [
                'message'   => 'Your post has been permanently deleted!',
                'type'      => 'info'
            ]
        ]);
    }

    public function restore($id)
    {
        Post::withTrashed()->where('id', $id)->restore();

        return redirect(route('posts.index'))->with('flash', [
            'snackbar'      => [
                'message'   => 'Your post has been restored!',
                'type'      => 'info'
            ]
        ]);
    }
}
