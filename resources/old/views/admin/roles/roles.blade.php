@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">roles</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach(/*that is come from the cotition' 'in reviewController*/ $roles as $rol)
                                <div class="col-md-4">
                                    <div class=" alert alert-danger">
                                        <p>{{$rol->role}} </p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        {{$roles->links()}}

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
