@extends('layouts.app')

@section('content')

    @includeIf("templates." . "default"  . ".head_display_index")
        @if($galleries)
            @includeIf("templates." . "default"  . ".image_display_index")
        @endif
        @includeIf("templates." . "default"  . ".post_display_index")
    @includeIf("templates." . "default"  . ".tail_display")

@endsection
