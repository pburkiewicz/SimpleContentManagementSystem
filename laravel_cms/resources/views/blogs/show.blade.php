
@extends('layouts.app')

@section('content')

    @includeIf("templates." . "default"  . ".head_display")
    @includeIf("templates." . "default"  . ".title_display")
    @if($galleries)
        @includeIf("templates." . "default"  . ".image_display")
    @endif
    @includeIf("templates." . "default"  . ".post_display")
    @includeIf("templates." . "default"  . ".comment_view")
    @includeIf("templates." . "default"  . ".tail_display")
@endsection
