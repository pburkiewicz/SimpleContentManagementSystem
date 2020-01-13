@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Posts:</h2>

                <a href="{{ route('blogs.create') }}">Create new...</a>

                <ul>
                    @forelse($blogs as $blog)
                        <li>
                            <h2><strong><a href ="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a></strong></h2> <span>{{ $blog->created_at }}</span>

                        <div>
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
