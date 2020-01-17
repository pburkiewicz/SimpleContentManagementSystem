<?php

namespace App\Http\Controllers;

use App\Page;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $user)
    {

        $User =User::where('page_name', $user)->first();

        if( $User == Auth::user()) {
            $pages = Page::where('user_id', $User->id)->get();
            return view('pages.index')->withUser($User)->withPages($pages);
        }
        return view('home')->withUser(Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $user)
    {

            return view('pages.create')->withUser($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // echo
        //if( $request->user()->page_name == $request->getPathInfo()[0]) {
            $this->validate($request, [
                'page_name' => 'required',
            ]);

            $page = new Page();

            $page->page_name = $request->page_name;
            $page->user_id = $request->user()->id;
            $page->page_type = $request->page_type;
            if ($page->page_type == 'blog'){
                $page->page_path = "/".$request->user()->page_name."/".$request->page_name."/blog";
                $page->save();
                return redirect()->route('blog.index', ['user'=> $request->user()->page_name, 'path' => $page->page_name]);
            }elseif ($page->page_type == "gallerie"){
                $page->page_path =  $request->user()->page_name.'/'.$request->page_name.'/gallery';
                $page->save();
                return redirect()->route('gallery.index', ['user'=> $request->user()->page_name, 'path' => $page->page_name]);
            }
    //    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
