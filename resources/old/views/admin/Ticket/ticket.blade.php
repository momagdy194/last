@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tickets</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach(/*that is come from the cotition' 'in reviewController*/ $tickets as $ticket)
                                <div class="col-md-4">
                                    <div class=" alert alert-danger">
                                        <h5>{{$ticket ->customer->format_name()}} </h5>
                                        <P>{{$ticket->statues}}</P>
                                        <p>{{$ticket->title}}</p>
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
