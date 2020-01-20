
@extends('layouts.app')

@section('content')
    @if(!$blank)
        <a href={{ route('blank.create', ['user' => $page->user->page_name,'path' => $page->page_name ]) }}>Create your own HTML</a>
    @else

        <a href={{ route('blank.edit', [ 'blank'=>$blank , 'user' => $page->user->page_name,'path' => $page->page_name]) }}>Edit your HTML</a>
    @endif
    @if($html)
        {!! $html !!}
    @endif
@endsection
