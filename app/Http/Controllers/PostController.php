<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Fruitcake\LaravelDebugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController  extends Controller
{   
        public function deletePost(Post $post) {
        if (auth()->user()->id === $post['user_id']) {
            $post->delete();//DELETE FROM posts WHERE id = 15;
        }
        return redirect('/');
    }
    
    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required', //field can not be empty
            'body' => 'required'
        ]);
        //strip_tags() removes HTML/PHP tags from the text
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = Auth::id(); //Get the logged-in user's ID
        //Laravel creates a new record in the posts table.
        //  $posts= Post::create($incomingFields);
        //  Debugbar::info("hiiiiii", $posts);
        return redirect('/');
    }

     public function showEditScreen(Post $post) {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        //Display the edit-post.blade.php view and give it the $post variable.
        return view('edit-post', ['post' => $post]);
    }

    public function actuallyUpdatePost(Post $post, Request $request) {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/');
    }
}
