<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        //
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Blog $blog)
    {
        return view('comments.create')->withBlog($blog);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'contents' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id= Auth::check() ? Auth::user()->getAuthIdentifier() : Auth::user(); // if user logged in
        $comment->blog_id= $blog->id;
        $comment->contents = $request->contents;
        $comment->save();

        return redirect()->route('blogs.show', $blog);
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Comment  $comment
//     * @return \Illuminate\Http\Response
//     */
//    public function show(Comment $comment)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog, Comment $comment)
    {
        if( Auth::check() ) {   # user is logged in
            if (Auth::user() == $comment->user) { # user is owner of comment
                return view('comments.edit')->withComment($comment);
            }
        }
        return redirect()->route('blogs.show', $blog);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     *  @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog, Comment $comment)
    {
        if( Auth::check() ) {   # user is logged in
            if (Auth::user() == $comment->user) { # user is owner of comment
                $this->validate($request, [
                    'contents' => 'required'
                ]);
                $comment->contents = $request->contents;
                $comment->save();
                return redirect()->route('blogs.show', $blog);
            }
        }
        return redirect()->route('blogs.show', $blog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog, Comment $comment)
    {
        if( Auth::check() ) {   # user is logged in
            if (Auth::user() == $comment->user or Auth::user() == $blog->user) { # user is owner of comment
                $comment->delete();
            }
        }
        return redirect()->route('blogs.show', $blog);
    }
}
