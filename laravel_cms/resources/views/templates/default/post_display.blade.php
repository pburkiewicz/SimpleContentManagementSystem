@markdown($blog->contents)
@if (Auth::user() == $blog->user)  {{-- Only the owner of the post is able to edit or delete it --}}
<a href="{{ route('blogs.edit', $blog) }}">edit</a>
<form method="post" action="{{ route('blogs.destroy', $blog) }}">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <input type="submit" value="Delete">
</form>
@endif
