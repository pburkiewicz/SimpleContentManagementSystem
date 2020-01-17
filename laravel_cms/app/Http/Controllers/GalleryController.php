<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('galleries.index_temp')->withGalleries($galleries);
        $gallery = Page::where('page_path',$request->getPathInfo())->orWhere('page_path',substr_replace($request->getPathInfo(), "", -1))->first();
        //$posts = Blog::where('page_id', $page->id)->get();

        $gallery = Gallery::where('page_id', $page->id)->get();
        $gallery = $posts->sortByDesc("created_at");
        // TODO... Fetch from style database table for current blog, and then set $template and pass to view.
        return view('galleries.index_temp')->withBlogs($posts)->withPage($page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('galleries.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
               $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'title' => 'required',


    ]);
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $filename = time() . '.' .$image->getFilename().'.'.$extension;
        Storage::disk('public')->put($filename,  File::get($image));

        $gallery = new Gallery;
        $gallery->title = $request->title;
        $gallery->description = $request ->description;
        $gallery->mime = $image->getClientMimeType();
        $gallery->original_filename = $image->getClientOriginalName();
        $gallery->filename = $filename;
        $gallery->save();
        //dd($gallery);
        return redirect('/gallery');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $image = Gallery::findOrFail($gallery);
        File::delete("uploads/" . $image[0]->filename);
        Gallery::findOrFail($gallery)->first()->delete();
        return redirect('gallery/');
    }
}
