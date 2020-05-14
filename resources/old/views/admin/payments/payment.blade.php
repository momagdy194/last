@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">payment</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach(/*that is come from the cotition' 'in reviewController*/ $payments as $payment)
                                <div class="col-md-4">
                                    <div class=" alert alert-danger">
                                        <p>{{$payment ->id}} </p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        {{$payments   ->links()}}

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
