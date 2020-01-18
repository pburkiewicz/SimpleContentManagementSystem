<?php

namespace App\Http\Controllers;

use App\Coworker;
use App\Page;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoworkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, string $user, string $path)
    {

        return view('coworker.create')->withPage(Page::where('page_name',$path)->first());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, string $user, string $path)
    {

        $this->validate($request, [
            'email'=>['required', 'string', 'email', 'max:255']
        ]);
        $coworker = new Coworker();
        $coworker->user_id = User::where('email',$request->email)->first()->id;
        $coworker->owner_id = $request->user()->id;
        $page = Page::where('page_name',$path)->first();
        $coworker->page_id=$page->id;
        $coworker->save();
        $user = Auth::user();
        return redirect($user->page_name . '/pages')->withUser($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coworker  $coworker
     * @return \Illuminate\Http\Response
     */
    public function show(Coworker $coworker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coworker  $coworker
     * @return \Illuminate\Http\Response
     */
    public function edit(Coworker $coworker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coworker  $coworker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coworker $coworker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coworker  $coworker
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $user, string $path, Coworker $coworker)
    {
        $coworker->delete();
        $user = Auth::user();
        return redirect($user->page_name . '/pages')->withUser($user);
    }
}
