<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function gate()
    {
        $post = Post::find(1);
        
        if (Gate::allows('update-post', $post)) {
            echo 'Allowed';
        } else {
            echo 'Not Allowed';
        }
        
        exit;
    }
}
