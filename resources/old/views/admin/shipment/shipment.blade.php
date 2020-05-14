@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">shipments</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach(/*that is come from the cotition' 'in reviewController*/ $shipments as $shipment)
                                <div class="col-md-4">
                                    <div class=" alert alert-danger">
                                        <p>{{$shipment ->user_id}} </p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        {{$shipments   ->links()}}

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
