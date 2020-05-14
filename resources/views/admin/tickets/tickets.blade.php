@extends('layouts.app')

@section('content')

     <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Tickets</h3>
            <div class="card">
                <div class="card-header">Tickets</div>
                  <div class="card-body">
                    <div class="row">
                     @foreach ($tickets as $ticket)
                      <div class="col-md-3">
                        <div class="alert alert-primary">
                            <h5>User: {{$ticket->customer->formattedName()}}</h5>
                             <p>{{$ticket->title}}</p>
                             <p>Ticktet Type: {{$ticket->tickitType->name}}</p>
                             <p>Status: <span style="color: red">{{$ticket->status}}</span></p>
                             <p>Date: {{$ticket->created_at->diffForHumans()}}</p>
                        </div>
                    </div>   
                      @endforeach
                    </div>
                    {{$tickets->links()}}
                  </div>
                </div>
               </div>
            </div>
         </div>

@endsection