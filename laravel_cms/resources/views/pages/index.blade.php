@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Your pages:</h2>

            <a href="{{ route('pages.create', $user->page_name) }}">Create a page.</a>

            <ul>
                @forelse($pages as $page)
                    <li>
                        <h2><strong><a href ="{{ url($page->page_path) }}">{{ $page->page_name }} -  {{ $page->page_type }}</a></strong></h2>
                        <a href="{{ route('coworker.create', ['user'=>$user->page_name,'page_id'=>$page->page_name]) }}">Invite coworker</a>
                        <ul>
                        @forelse($coworkers->where('page_id',$page->id) as $writer_data)

                                <li>{{\App\User::find($writer_data->user_id)->nick}}
                                    <form method="post" action="{{ route('coworker.destroy', ['user' => $user->page_name, 'page_id' => $page->page_name, 'coworker' => $writer_data ]) }}">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <input type="submit" value="Delete">
                                    </form>
                                </li>
                        @empty
                            <p>No coworkers.</p>
                        @endforelse
                        </ul>
                    </li>
                @empty
                    <p>No pages.</p>
                @endforelse
            </ul>
            <h2>Pages as coworker</h2>
            <ul>
                @forelse($copages as $page_temp)
                    <li>
                        @php
                        $page= App\Page::where('id',$page_temp->page_id)->first()
                        @endphp
                        <h2><strong><a href ="{{ url($page->page_path) }}">{{ $page->page_name }} -  {{ $page->page_type }}</a></strong></h2>owner: {{\App\User::find($page->user_id)->nick}}
                    </li>
                @empty
                    <p>No pages.</p>
                @endforelse
            </ul>
        </div>
    </div>
</div>


@endsection

