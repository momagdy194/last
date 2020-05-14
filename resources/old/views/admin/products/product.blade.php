@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">product</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach(/*that is come from the cotition' 'in reviewController*/ $products as $product)
                                <div class="col-md-4">
                                    <div class=" alert alert-danger">

                                        <p>{{$product ->title}} </p>
                                        <p> category: {{   $product->category->name}}</p>
                                        <p>{{$product ->price }} {{''.$currency_code}} }}</p>

                                        {!!(count( $product->images)>0)? '<img  class="img-thumbnail card-img" src="'. $product->images[0]->url .'"/>':''!!}
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        {{$products   ->links()}}

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
