@extends('layouts.app')

@section('content')

    @includeIf("templates." . "default"  . ".head_display")
        @includeIf("templates." . "default"  . ".post_display_index")
    @includeIf("templates." . "default"  . ".tail_display")

@endsection
