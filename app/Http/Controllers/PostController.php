<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function update(Request $request, Post $post)
{
    $this->authorize('update', $post);

    // The current user can update the blog post...
}
}
