@markdown($blog->contents)
@if (Auth::user() == $blog->page->user)  {{-- Only the owner of the post is able to edit or delete it--}}
@if( $blog->page->page_type == "blog")
<a href ="{{ route('blog.edit', [ 'blog' => $blog, 'user' => $blog->page->user->page_name, 'path' => $blog->page->page_name ]) }}"><strong>edit</strong></a>
@elseif( $blog->page->page_type == "gallery")
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
