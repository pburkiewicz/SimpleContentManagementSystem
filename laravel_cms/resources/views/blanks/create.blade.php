@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Own HTML') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('blank.store', ['user' => $page->user->page_name, 'path' => $page->page_name]) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="contents" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                                <div class="col-md-6">
                                    <textarea id="contents"  class="form-control @error('contents') is-invalid @enderror" name="contents" required autocomplete="contents" autofocus>{{ old('contents') }}</textarea>

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
                                        {{ __('Publish') }}
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
