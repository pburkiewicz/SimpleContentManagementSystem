@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Posts:</h2>

                <a href="{{ url($page->page_path.'/create') }}">Create new...</a>

                <ul>
                    @forelse($blogs as $blog)
                        <li>
                            <h2><strong><a href ="{{ route('blog.show', [ 'blog' => $blog, 'user' => $page->user->page_name, 'path' => $page->page_name , 1]) }}">{{ $blog->title }}</a></strong></h2> <span>{{ $blog->created_at }}</span>

                        <div>
                            @if($image=\App\Gallery::where('blog_id', $blog->id)->first())
                                <div class="card">
                                    <img class="card-img-top" src="{{url('uploads/'.$image->filename)}}" alt="{{$image->original_filename}}">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <strong>
                                                @markdown($image->description)
                                            </strong>
                                    </div>
                                </div>
                            @endif
                            <p>
                                @markdown($blog->contents)
                            </p>
                        </div>
                        </li>
                        @empty
                            <p>No posts.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
