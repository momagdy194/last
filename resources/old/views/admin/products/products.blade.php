@extends('layouts.app')

@section('content')

     <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Products</h3>
            <div class="card">
            <div class="card-header">Products <a href="{{route('new-product')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i></a> </div>
                  <div class="card-body">
                    <div class="row">
                     @foreach ($products as $product)
                      <div class="col-md-4">
                        <div class="alert alert-primary">
                            <p>Products Name:{{$product->title}}</p>
                            <p>Category: {{ is_object($product->category) ? $product->category->name : ''}}</p>
                            <p>Product price: {{ $currency_code }}{{$product->price}}</p>
                                {!! ( count($product->images) > 0) ? '<img class="img-thumbnail card-img" src ="'.asset("storage/".$product->images[0]->url).'"/>' : '' !!}
                              @if (! is_null($product->options))

                                @foreach ($product->jsonOptions() as $key => $values)
                                    <div class="row">
                                       <div class="form-group  col-md-12">
                                         <label for="{{ $key }}">{{ strtoupper($key) }}</label>
                                          <select class="form-control" name="{{ $key }}" id="{{ $key }}">
                                            @foreach ($values as $value)
                                              <option value="{{ $value }}">{{ strtoupper($value) }}</option>
                                            @endforeach
                                          </select>
                                       </div>
                                    </div>
                                @endforeach
                             
                              @endif

                            {{-- @if (! is_null($product->options))
                              <table class="table-bordered table">
                              @foreach ($product->jsonOptions() as $optionKey =>  $options)
                                   @foreach ($options as $option)
                                       <tr>
                                         <td>
                                           {{ $optionKey }}
                                         </td>
                                        <td>{{ $option }}</td>
                                       </tr>
                                   @endforeach
                               @endforeach
                               </table>
                            @endif --}}

                        <a  class="btn btn-success mt-2" href="{{route('update-new-product' , ['id' => $product->id])}}">Update Product</a>

                        </div>
                    </div>   
                      @endforeach
                    </div>
                    {{$products->links()}}
                  </div>
                </div>
               </div>
            </div>
         </div>

    @if (Session::has('message'))
      <div class="toast" style="position: absolute; z-index: 99999; top: 5%; right: 5%; background-color:blanchedalmond">
        <div class="toast-header">
          <strong class="mr-auto">Product</strong>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="toast-body">
          <span style="">  {{ Session::get('message') }}</span>
        </div>

      </div>
    </div>
  @endif
@endsection

@section('scripts')
     @if (Session::has('message'))
    <script>
      
      $(document).ready(function(){
        var  $toast = $('.toast').toast({
          autohide : false
        });
        $toast.toast('show');
      });

    </script>
  @endif
@endsection