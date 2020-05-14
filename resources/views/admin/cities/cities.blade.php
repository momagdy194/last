@extends('layouts.app')

@section('content')

     <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Cities</h3>
            <div class="card">
                <div class="card-header">Cities</div>
                  <div class="card-body">
                    <div class="row">
                     @foreach ($cities as $city)
                      <div class="col-md-3">
                        <div class="alert alert-primary">
                             <h5>{{$city->name}}</h5>
                            <p>State: {{$city->state->name}}</p>
                            <p>Country: {{$city->country->name}}</p>
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