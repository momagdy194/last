@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">orders</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach(/*that is come from the cotition' 'in reviewController*/ $orders as $order)
                                <div class="col-md-4">
                                    <div class=" alert alert-danger">
                                        <p>{{$order ->id}} </p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        {{$orders->links()}}
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
