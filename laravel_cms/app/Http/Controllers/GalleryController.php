<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Coworker;
use App\Gallery;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = Page::where('page_path',$request->getPathInfo())->orWhere('page_path',substr_replace($request->getPathInfo(), "", -1))->first();
        $posts = Blog::where('page_id', $page->id)->with('page')->orderBy('created_at', 'desc')->paginate(10);
        // TODO... Fetch from style database table for current blog, and then set $template and pass to view.
        $coworkers = Coworker::where('page_id', $page->id)->where('user_id',Auth::user()->id)->first();
        return view('galleries.index')->withBlogs($posts)->withPage($page)->withCoworkers($coworkers)->withUser(Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, string $user, string $path)
    {
        return view('galleries.upload')->withPage(Page::where('page_name',$path)->first());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,string $user, string $path)
    {
        $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'title' => 'required',
    ]);

        $blog = new Blog();
        $blog['title']= $request->title;
        $blog->user_id=Auth::user()->id;
        $blog->contents = NULL;
        $blog->page_id = Page::where('page_name',$path)->first()->id;
        $blog->save();
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $filename = time() . '.' . $image->getFilename() . '.' . $extension;
        Storage::disk('public')->put($filename, File::get($image));

        $gallery = new Gallery;
        $gallery->description = $request->description;
        $gallery->mime = $image->getClientMimeType();
        $gallery->original_filename = $image->getClientOriginalName();
        $gallery->filename = $filename;
        $gallery->blog_id=$blog->id;
        $gallery->page_id=$blog->page_id;
        $gallery->save();
        return redirect()->route('gallery.show', ['user' => $user, 'path' => $path, 'gallery' =>$blog]);
               ///
    }

    /**
     * Display thbloge specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(string $user, string $path, string $blog)
    {
        //$comments = $blog->find($blog->id)->comments;
        $blog = Blog::where('id', $blog)->first();
        $galleries = Gallery::where('blog_id', $blog->id)->first();
//        $blog = Blog::where('id', $galleries->blog_id)->first();
        $coworkers = Coworker::where('page_id', $blog->page_id)->first();
        return view('galleries.show')->withBlog($blog)->withGalleries($galleries)->withCoworkers($coworkers);// ->withComments($comments)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(string $user, string $path, string $blog)
    {
        $blog = Blog::where('id', $blog)->first();
        $galleries = Gallery::where('blog_id', $blog->id)->first();

        return view('galleries.edit')->withBlog($blog)->withGalleries($galleries);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $user, string $path, string $blog)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
        ]);

        $blog = Blog::where('id', $blog)->first();
        $gallery = Gallery::where('blog_id', $blog->id)->first();
        $blog['title'] = $request->title;

        $image = $request->file('image');

        if ($image) {
            $extension = $image->getClientOriginalExtension();

            $filename = time() . '.' . $image->getFilename() . '.' . $extension;
            Storage::disk('public')->put($filename, File::get($image));
            File::delete("uploads/" . $gallery->filename);
            $gallery->mime = $image->getClientMimeType();
            $gallery->original_filename = $image->getClientOriginalName();
            $gallery->filename = $filename;
        }
        $gallery->blog_id=$blog->id;
        $gallery->description = $request->description;
        $gallery->save();


        $blog->save();
        return redirect()->route('gallery.show', ['user'=>$user, 'path'=> $path, 'gallery' =>$blog]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $user, string $path, string $blog)
    {
        $images = Gallery::where('blog_id',$blog)->get();
        $temp = $images[0]->blog_id;

        foreach( $images as $image){
            File::delete("uploads/" . $image->filename);
        }
        Blog::where('id',$temp)->delete();
        return redirect()->route('gallery.index', ['user'=>$user, 'path'=> $path]);
    }
}

