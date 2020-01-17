@extends('layouts.app')

@section('content')

    @includeIf("templates." . "default"  . ".head_display")
    @forelse($blogs as $blog)
        @if($galleries=\App\Gallery::where('blog_id', $blog->id)->first())
            @includeIf("templates." . "default"  . ".image_display")
        @endif
    @empty
        <p>No images.</p>
    @endforelse

    @includeIf("templates." . "default"  . ".tail_display")

@endsection


