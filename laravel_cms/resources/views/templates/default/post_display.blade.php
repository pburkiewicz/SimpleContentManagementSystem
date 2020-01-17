@markdown($blog->contents)
@if (Auth::user() == $blog->page->user)  {{-- Only the owner of the post is able to edit or delete it --}}
<a href="{{ route('blog.edit', ['user' => $blog->page->user->page_name,'path' => $blog->page->page_name, 'blog' => $blog ]) }}">edit</a>
<form method="post" action="{{ route('blog.destroy', ['user' => $blog->page->user->page_name,'path' => $blog->page->page_name, 'blog' => $blog ]) }}">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <input type="submit" value="Delete">
</form>
@endif
