@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cities</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($cities as $city)
                                <div class="col-md-4">
                                    <div class=" alert alert-danger">
                                        <p>{{$city ->name   }} </p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        {{$cities->links()}}

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
