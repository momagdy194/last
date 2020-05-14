@extends('layouts.app')

@section('content')

     <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>States</h3>
            <div class="card">
                <div class="card-header">States</div>
                  <div class="card-body">
                    <div class="row">
                     @foreach ($states as $state)
                      <div class="col-md-3">
                        <div class="alert alert-primary">
                             <h5>{{$state->name}}</h5>
                             <p>Country:{{$state->country->name}}</p>
                        </div>
                    </div>   
                      @endforeach
                    </div>
                    {{$states->links()}}
                  </div>
                </div>
               </div>
            </div>
         </div>

@endsection