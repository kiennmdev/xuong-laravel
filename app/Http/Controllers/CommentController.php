<?php

namespace App\Http\Controllers;

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
