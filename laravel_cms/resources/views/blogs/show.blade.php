@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>{{ $blogs->title }}</h2>
                <span>{{ $blogs->created_at }}</span>
                @markdown($blogs->contents)

                <a href="{{ route('comments.create', $blogs) }}">Add comment</a>

                @if (Auth::user() == $blogs->user)  {{-- Only the owner of the post is able to edit or delete it --}}
                    <a href="{{ route('blogs.edit', $blogs) }}">edit</a>
                    <form method="post" action="{{ route('blogs.destroy', $blogs) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" value="Delete">
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
