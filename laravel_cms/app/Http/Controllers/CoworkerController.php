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
        $user = Auth::user();
        $this->validate($request, [
            'email'=>['required', 'string', 'email', 'max:255']
        ]);
        $mail = User::where('email',$request->email)->first();
        $page = Page::where('page_name',$path)->first();
        if (!$mail)
        {
            return view('coworker.create')->withPage(Page::where('page_name',$path)->first())->withInfo("Given email couldn't be found");
        }
        if ($mail->id==$user->id)
        {
            return view('coworker.create')->withPage(Page::where('page_name',$path)->first())->withInfo("You can't invite yourself!");
        }
        $coworker = Coworker::where('owner_id', $user->id)->where('page_id', $page->id)->where('user_id',$mail->id)->first();
        if($coworker)
        {
            return view('coworker.create')->withPage(Page::where('page_name',$path)->first())->withInfo("User already invited!");
        }
        $coworker = new Coworker();
        $coworker->user_id = $mail->id;
        $coworker->owner_id = $request->user()->id;
        $coworker->page_id=$page->id;
        $coworker->save();
        //route('pages.index', ['user' => $user->page_name])
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
