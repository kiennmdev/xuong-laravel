<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    const PATH_VIEW = 'admin.comments.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::withTrashed()->with('user', 'product')->latest('id')->paginate(10);
        // dd($comments->toArray());
        return view(self::PATH_VIEW . __FUNCTION__, compact('comments'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function sortDelete(Comment $comment) {
        $comment->delete();
        return back();
    }

    public function restore(string $id) {
        $comment = Comment::withTrashed()->find($id);
        $comment->restore();
        return back();
    }

}
