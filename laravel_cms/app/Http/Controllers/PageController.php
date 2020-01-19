<?php

namespace App\Http\Controllers;

use App\Coworker;
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
            $coworkers = Coworker::where('owner_id',$User->id);
            $coworkers = $coworkers->get();
            $copages = Coworker::where('user_id', $User->id)->get();

            $pages = Page::where('user_id', $User->id)->get();
            return view('pages.index')->withUser($User)->withPages($pages)->withCoworkers($coworkers)->withCopages($copages);
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
        //if( $request->user()->page_name == $request->getPathInfo()[0]) {

            $this->validate($request, [
                'page_name' => 'required|alpha_dash|unique:pages,page_name,NULL,user_id'
            ]);

            $page = new Page();

            $page->page_name = $request->page_name;
            $page->user_id = $request->user()->id;
            $page->page_type = $request->page_type;
            if ($page->page_type == 'blog'){
                $page->page_path = "/".$request->user()->page_name."/".$request->page_name."/blog";
                $page->save();
                return redirect()->route('blog.index', ['user'=> $request->user()->page_name, 'path' => $page->page_name]);
            }elseif ($page->page_type == "gallery"){
                $page->page_path = "/". $request->user()->page_name.'/'.$request->page_name.'/gallery';
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
    public function destroy(string $user, Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index',  $user);
    }
}
