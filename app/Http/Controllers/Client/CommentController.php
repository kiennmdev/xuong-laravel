<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function save(Request $request)
    {

        $data = $request->all();
        
        Comment::query()->create($data);

        return back();
    }
}
