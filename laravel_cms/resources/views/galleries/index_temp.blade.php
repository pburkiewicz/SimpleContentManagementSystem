@extends('layouts.app')

@section('content')
    <a href="gallery/create">Add image</a>
@foreach($galleries as $image)
<div>
    <h3>{{ $image->title}}</h3>
    <div class="card">
        <img class="card-img-top" src="{{url('uploads/'.$image->filename)}}" alt="{{$image->original_filename}}">
        <div class="card-body">
            <p class="card-text">
                <strong>
                    @markdown($image->description)
                </strong>
            <form action="/gallery/{{$image->id}}" method="POST">
                @csrf
                @method("DELETE")
                <input  type="submit" name="Delete" value="Delete">
            </form>
            </p>
        </div>
    </div>
</div>
@endforeach
@endsection
