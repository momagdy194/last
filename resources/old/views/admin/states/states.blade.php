@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">statues</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($statues as $state)
                                <div class="col-md-4">
                                    <div class=" alert alert-danger">
                                        <p>{{$state ->name}} </p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        {{$statues->links()}}

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
