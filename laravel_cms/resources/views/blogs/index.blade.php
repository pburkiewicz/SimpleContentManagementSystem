@extends('layouts.app')

@section('content')

    @includeIf("templates." . "default"  . ".head_display")

        @includeIf("templates." . "default"  . ".post_index_display")
    @includeIf("templates." . "default"  . ".tail_display")

@endsection
