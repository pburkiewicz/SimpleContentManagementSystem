@extends('layouts.app')

@section('content')
    <a href="gallery/create">Add image</a>
@foreach($galleries as $image)
<div>
    <h3>{{ $image->name}}</h3>
    <div class="card">
        <img class="card-img-top" src="{{url('uploads/'.$image->filename)}}" alt="{{$image->filename}}">
        <div class="card-body">
            <p class="card-text">
                <strong>
                    @markdown("{{ $image->description}}")
                </strong>
            </p>
        </div>
    </div>
</div>
@endforeach
@endsection
