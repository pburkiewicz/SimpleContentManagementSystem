<div class="card">
                    <img class="card-img-top" src="{{url('uploads/'.$galleries->filename)}}" alt="{{$galleries->original_filename}}">
                    <div class="card-body">
                        <p class="card-text">
                            <strong>
@markdown($galleries->description)
                            </strong>
                    </div>
                </div>
