<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Gallery;
use App\User;
use App\Page;
class BlogController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/

public function index(Request $request)
{

$page = Page::where('page_path',$request->getPathInfo())->orWhere('page_path',substr_replace($request->getPathInfo(), "", -1))->first();
$posts = Blog::where('page_id', $page->id)->get();
//dd($page,$page->id,$posts,Blog::where('page_id', $page->id)->get(), Blog::all());

return view('blogs.index')->withBlogs($posts)->withPage($page);
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create(Request $request, string $user, string $path)
{

return view('blogs.create')->withPage(Page::where('page_name',$path)->first());
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request,string $user, string $path)
{

$this->validate($request, [
'title' => 'required',
'contents' => 'required',
'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
]);

$blog = new Blog();
$blog['title']= $request->title;
$blog->contents = $request->contents;

$blog->page_id = Page::where('page_name',$path)->first()->id;
$blog->save();

$image = $request->file('image');
if($image) {
$extension = $image->getClientOriginalExtension();
$filename = time() . '.' . $image->getFilename() . '.' . $extension;
Storage::disk('public')->put($filename, File::get($image));

$gallery = new Gallery;
$gallery->description = $request->description;
$gallery->mime = $image->getClientMimeType();
$gallery->original_filename = $image->getClientOriginalName();
$gallery->filename = $filename;
$gallery->blog_id=$blog->id;
$gallery->save();
}
echo $blog;
return redirect()->route('blog.show', ['user' => $user, 'path' => $path, 'blog' =>$blog]);
}

/**
* Display the specified resource.
*
* @param  \App\Blog  $blog
* @return \Illuminate\Http\Response
*/
public function show(string $user, string $path,Blog $blog)
{
$comments = $blog->find($blog->id)->comments;
$galleries = Gallery::where('blog_id', $blog->id)->first();
return view('blogs.show')->withBlog($blog)->withComments($comments)->withGalleries($galleries);
}

/**
* Show the form for editing the specified resource.
*
* @param  \App\Blog  $blog
* @return \Illuminate\Http\Response
*/
public function edit(string $user, string $path, Blog $blog)
{
    $galleries = Gallery::where('blog_id', $blog->id)->first();
return view('blogs.edit')->withBlog($blog)->withGalleries($galleries);
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  \App\Blog  $blog
* @return \Illuminate\Http\Response
*/
public function update(Request $request, string $user, string $path, Blog $blog)
{
$this->validate($request, [
'title' => 'required',
'contents' => 'required'
]);

$blog['title']= $request->title;
$blog->contents = $request->contents;
$blog->save();

return redirect()->route('blog.show', ['user'=>$user, 'path'=> $path, 'blog' =>$blog]);
}

/**
* Remove the specified resource from storage.
*
* @param  \App\Blog  $blog
* @return \Illuminate\Http\Response
*/
public function destroy(string $user, string $path, Blog $blog)
{
$images = Gallery::where('blog_id',$blog->id)->get();
foreach( $images as $image){
File::delete("uploads/" . $image->filename);
}
$blog->delete();
return redirect()->route('blog.index', ['user'=>$user, 'path'=> $path]);
}
}
