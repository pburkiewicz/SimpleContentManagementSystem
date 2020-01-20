<strong>Comments</strong>
<a href="{{ route('comments.create', ['user' => $blog->page->user->page_name,'path' => $blog->page->page_name, 'blog' => $blog ]) }}">Add comment</a>
<ul>
    @forelse ( $comments as  $comment)
        <li>

            @if ( $comment->user )
                <a href="/{{ $comment->user->page_name }}">{{ $comment->user->nick}}</a>
                {{-- url to user's main page --}}
            @else Anonymous user
            @endif
            {{ $comment->created_at }}</li>
        {{ $comment->contents }} <br>

        @if( Auth::check() )    {{-- user is logged in --}}
        @if (Auth::user() == $comment->user) {{-- user is owner of comment --}}
        <a href="{{ route('comments.edit', [ 'user' => $blog->page->user->page_name,'path' => $blog->page->page_name, 'blog'=>$blog, 'comment'=>$comment]) }}">edit comment</a>
        @endif
        @if (Auth::user() and (Auth::user() == $comment->user or Auth::user() == $blog->user or Auth::user()->id == $coworkers->user_id))  {{-- owner of the comment and owner of the post are able to delete a comment --}}
        <form method="post" action="{{ route('comments.destroy', ['user' => $blog->page->user->page_name,'path' => $blog->page->page_name,'blog' => $blog, 'comment' => $comment]) }}">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <input id="delete_comment" type="submit" value="Delete">
        </form>
        @endif
        @endif
    @empty
        <p>No comments.</p>
    @endforelse
</ul>
{{ $comments->render() }}
