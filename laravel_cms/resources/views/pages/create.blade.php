@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Posts') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pages.store', ['user' => $user]) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="page_type" class="col-md-4 col-form-label text-md-right">{{ __('Page Type') }}</label>

                                <div class="col-md-6">
                                    <select id="page_type" class="form-control @error('page_type') is-invalid @enderror" name="page_type" value="{{ old('page_type') }}" autofocus>
                                        <option value="blog">blog</option>
                                        <option value="gallery">gallery</option>
                                        <option value="blank">blank</option>
                                    </select>
                                    @error('page_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="page_path" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="page_name" type="text" class="form-control @error('page_name') is-invalid @enderror" name="page_name" value="{{ old('page_name') }}" required autocomplete="page_name" autofocus>

                                    @error('page_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add page') }}
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
