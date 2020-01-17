@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Pages:</h2>

            <a href="{{ route('pages.create', $user->page_name) }}">Create a page.</a>

            <ul>
                @forelse($pages as $page)
                    <li>
                        <h2><strong><a href ="{{ url($page->page_path) }}">{{ $page->page_name }} -  {{ $page->page_type }}</a></strong></h2>

                    </li>
                @empty
                    <p>No pages.</p>
                @endforelse
            </ul>
        </div>
    </div>
</div>


@endsection

