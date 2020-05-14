@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tags</div>


                    <div class="card-body">

                        <form action="{{route('tags')}}" method="post" class="row">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="tag_name">Unit Name</label>
                                <input type="text" class="form-control" id="tag_name" name="tag_name"
                                       placeholder="Tag Name" required>
                            </div>

                            <div class="form-group col-md-6 col-md-12 ">
                                <button type="submit" class="btn btn-outline-danger">see new danger</button>
                            </div>
                        </form>


                        <div class="row">
                            @foreach(/*that is come from the cotition' 'in reviewController*/ $tags as $tag)
                                <div class="col-md-4">
                                    <div class=" alert alert-danger">
                                        <p>{{$tag ->tag}} </p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        {{$tags->links()}}

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
