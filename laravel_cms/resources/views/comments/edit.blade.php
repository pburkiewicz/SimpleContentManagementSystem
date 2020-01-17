
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit a comment') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('comments.update', ['user' => $comment->blog->page->user->page_name,'path' => $comment->blog->page->page_name,'blog' => $comment->blog, 'comment' => $comment]) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group row">
                                <label for="contents" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

                                <div class="col-md-6">
                                    <textarea id="contents"  class="form-control @error('contents') is-invalid @enderror" name="contents" required autocomplete="contents" autofocus>{{  $comment->contents }}</textarea>

                                    @error('contents')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit comment') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
