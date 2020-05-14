@extends('layouts.app')

@section('content')

     <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Countries</h3>
            <div class="card">
                <div class="card-header">Countries</div>
                  <div class="card-body">
                    <div class="row">
                     @foreach ($countries as $country)
                      <div class="col-md-3">
                        <div class="alert alert-primary">
                             <h5>{{$country->name}}</h5>
                            <p>Country Currency: {{$country->currency}}</p>
                            <p>Country Capital: {{$country->capital}}</p>
                        </div>
                    </div>   
                      @endforeach
                    </div>
                    {{$countries->links()}}
                  </div>
                </div>
               </div>
            </div>
         </div>

@endsection