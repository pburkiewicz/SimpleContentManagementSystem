@markdown($blog->contents)
@if (Auth::user() and (Auth::user() == $blog->page->user or Auth::user()->id == $blog->user_id))  {{-- Only the owner of the post is able to edit or delete it--}}
    @if( $blog->page->page_type == "blog" and Auth::user()->id == $blog->user_id)
        <a href ="{{ route('blog.edit', [ 'blog' => $blog, 'user' => $blog->page->user->page_name, 'path' => $blog->page->page_name ]) }}"><strong>edit</strong></a>
    @elseif( $blog->page->page_type == "gallery" and Auth::user()->id == $blog->user_id)
        <a href ="{{ route('gallery.edit', ['gallery' =>$blog->id, 'user' => $blog->page->user->page_name, 'path' => $blog->page->page_name]) }}"><strong>edit</strong></a>
    @endif

    @if( $blog->page->page_type == "blog"):
        <form method="post" action="{{ route('blog.destroy', ['user' => $blog->page->user->page_name,'path' => $blog->page->page_name, 'blog' => $blog ]) }}">
    @elseif( $blog->page->page_type == "gallery"):
        <form method="post" action="{{ route('gallery.destroy', ['gallery' =>$blog->id, 'user' => $blog->page->user->page_name, 'path' => $blog->page->page_name]) }}">
    @endif
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <input id="delete_post" type="submit" value="Delete">
    </form>
@endif
