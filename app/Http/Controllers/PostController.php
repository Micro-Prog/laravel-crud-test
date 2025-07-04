<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function deletePost(Post $post) {
        if (auth()->user()->id === $post['user_id']) {
            $post->delete();
        }

        return redirect('/');

    }


    // Display the edit form
    public function showEditPost(Post $post) {

        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }


        return view('edit-post', ['post' => $post]);
    }

    // Handle the creation of a post
    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect('/');
    }

    // Handle the update of a post
    public function updatePost(Request $request, Post $post) {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        // Sanitize the data before saving
        $validated['title'] = strip_tags($validated['title']);
        $validated['body'] = strip_tags($validated['body']);

        // Update the post with the validated data
        $post->update($validated);

        // Redirect with a success message
        return redirect('/')->with('success', 'Post updated successfully!');
    }
}
