@extends('layouts.app')

@section('content')
<form method="post" action="/gallery" enctype="multipart/form-data">
{{ csrf_field() }}

<div class="form-group">
    <label>Title:</label>
    <input type="text" class="form-control" name="title" value="{{old("title")}}"/>
</div>
    <div class="form-group">
        <label>Your Image:</label>
        <input type="file" class="form-control" name="image" value="{{old("image")}}"/>
    </div>
    <div class="form-group">
        <label>Image Description:</label>
        <textarea class="input-group" cols="30" rows ="10" type="text" name="description" >{{old("description")}}</textarea><br>
    </div>
    <div class="form-group">
        <input type="submit" value="Upload">
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</form>
@endsection
