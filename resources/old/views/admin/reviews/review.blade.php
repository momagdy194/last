@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">review</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach(/*that is come from the cotition' 'in reviewController*/ $reviews as $review)
                                <div class="col-md-4">
                                    <div class=" alert alert-danger">
                                        <p>{{$review->customer->format_name()}}</p>
                                        <P>{{$review->product->title}}</P>
                                        <p>{{$review ->review}} </p>
                                        <?php
                                        $totalStar=5;
                                        $curantStar=$review->stars;
                                        $reminingStar=$totalStar-$curantStar;
                                        ?>
                                        <P>
                                        @for($i=0 ;$i <$review->stars;$i ++)
                                                <i class="fas fa-star"></i>

                                                @endfor
                                            @for($i=0 ;$i <$reminingStar;$i ++)
                                                <i class="far fa-star"></i>

                                            @endfor

                                        </P>

                                        <P>{{$review->humanTime()}}</P>

                                    </div>

                                </div>
                            @endforeach
                        </div>
                        {{$reviews   ->links()}}

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
