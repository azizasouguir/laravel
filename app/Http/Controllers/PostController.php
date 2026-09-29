<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController  extends Controller
{
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
        Post::create($incomingFields);
        return redirect('/');
    }
}
