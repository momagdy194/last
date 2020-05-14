@extends('layouts.app')



@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">unites</div>

                    <div class="card-body">

                        <form action="{{route('unites')}}" method="post" class="row">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="unites_name">Unit Name</label>
                                <input type="text" class="form-control" id="unites_name" name="unites_name"
                                       placeholder="Unit Name" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="unites_code">Unit Code</label>
                                <input type="text" class="form-control" id="unites_code" name="unites_code"
                                       placeholder="Unit Code" required>
                            </div>

                            <div class="form-group col-md-6 col-md-12 ">
                                <button type="submit" class="btn btn-outline-danger">see new danger</button>
                            </div>
                        </form>
                    </div>

                    <form action="{{route('search-units')}} " method="get">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="units_search" name="units_search"
                                       placeholder="Search">
                            </div>
                            <div class="form-group col-md-6">
                                <button class="btn btn-outline-danger ">sss</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        @foreach($unites as $Unit)
                            <div class="col-md-4">
                                <div class=" alert alert-danger">
                               <span class="buttons-span">
                                     <span>
                                         <form action="{{route('unites')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="{{$Unit->id}}">
                                                <button type="submit" class="delete-btn"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                     </span>
                                </span>
                                    <p>{{$Unit->unites_name}} =>{{$Unit->unites_code}} </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{(!$unites instanceof collection)?$unites->links():''}}
                </div>
            </div>
        </div>
    </div>
    {{--//===================================================================================================--}}


    {{--//===================================================================================================--}}

    <div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal edit-window" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
{{--//===================================================================================================--}}
@section('script')
    <script>
        $(document).ready(function () {
            var $deleteunit = $('.delete-unit');
            var $deletewindow = $('#delete-window');
            $deleteunit.on('click', function (element) {
                $deletewindow.modal('show');
                element.preventDefault();
            });
        });
    </script>
@endsection



