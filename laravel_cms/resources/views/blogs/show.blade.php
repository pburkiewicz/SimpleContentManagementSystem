
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>{{ $blog->title }}</h2>
                <span>{{ $blog->created_at }}</span>
                @markdown($blog->contents)
                @if (Auth::user() == $blog->user)  {{-- Only the owner of the post is able to edit or delete it --}}
                <a href="{{ route('blogs.edit', $blog) }}">edit</a>
                <form method="post" action="{{ route('blogs.destroy', $blog) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" value="Delete">
                </form>
                @endif


                <strong>Comments</strong>
                <a href="{{ route('comments.create', $blog) }}">Add comment</a>
                <ul>
                @forelse ( $comments as  $comment)
                    <li>
                        @if ( $comment->user_id )
                            {{--
                                TODO...
                                        <a href="{{ $comment->user->page_path }}">{{ $comment->user->nick}}</a>
                                        url to the page of user
                            --}}
                            {{ $comment->user->nick}}
                        @else Anonymous user
                        @endif
                        {{ $comment->created_at }}</li>
                        {{ $comment->contents }}

                        @if( Auth::check() )    {{-- user is logged in --}}
                            @if (Auth::user() == $comment->user) {{-- user is owner of comment --}}
                                <a href="{{ route('comments.edit', [ 'blog'=>$blog, 'comment'=>$comment]) }}">edit comment</a>
                            @endif
                            @if (Auth::user() == $comment->user or Auth::user() == $blog->user)  {{-- owner of the comment and owner of the post are able to delete a comment --}}
                                <form method="post" action="{{ route('comments.destroy', ['blog' => $blog, 'comment' => $comment]) }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <input type="submit" value="Delete">
                                </form>
                            @endif
                        @endif
                    @empty
                    <p>No comments.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
