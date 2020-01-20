<?php
namespace App\Http\Controllers;

use App\Blank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Page;
class BlankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, string $user, string $path)
    {
        $page = Page::where('page_path',$request->getPathInfo())->orWhere('page_path',substr_replace($request->getPathInfo(), "", -1))->first();
        $html = NULL;
        $blank = NULL;
        $temp = $page->page_path . '.html';
        if(Storage::exists($temp)) {
            $html = Storage::get($temp);
            $blank = Blank::where('filename', $temp)->first();
        }
        return view('blanks.index')->withHtml($html)->withPage($page)->withBlank($blank);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $user, string $path)
    {
        $page = Page::where('page_path','/'.$user.'/'.$path.'/blank')->first();
        return view('blanks.create')->withPage($page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, string $user, string $path)
    {
        $page = Page::where('page_path','/'.$user.'/'.$path.'/blank')->first();
        $blank = new Blank();
        $blank->filename = $page->page_path.'.html';
        $blank->page_id = $page->id;
        $blank->save();
        Storage::disk('local')->put($page->page_path.'.html' , $request->contents);
        return redirect()->route('blank.index', ['user' => $user, 'path' => $path]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blank  $blank
     * @return \Illuminate\Http\Response
     */
    public function show(Blank $blank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blank  $blank
     * @return \Illuminate\Http\Response
     */
    public function edit(string $user, string $path,string $blank)
    {
        $blank = Blank::where('id', $blank)->first();
        $page = Page::where('id', $blank->page_id)->first();
        $html = Storage::get($page->page_path . '.html');
        return view('blanks.edit')->withPage($page)->withHtml($html)->withBlank($blank);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blank  $blank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $user, string $path, Blank $blank)
    {
        $page = Page::where('page_path','/'.$user.'/'.$path.'/blank')->first();
        Storage::put($page->page_path.'.html', $request->contents);
        return redirect()->route('blank.index', ['user' => $user, 'path' => $path]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blank  $blank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blank $blank)
    {
        //
    }
}
