@extends('layouts.app')


@section('content')

    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                {!! !is_null($product) ? 'Update Product <span class ="product-header-title "> ' . $product->title . '</span>' : 'New Product'  !!}    
            </div>
            <div class="card-body">
              <form action="{{  (! is_null($product)) ?  route('update-product')   : route('new-product') }}" method="post" class="row" enctype="multipart/form-data">
                   @csrf
                   @if (! is_null($product))
                       <input type="hidden" name="_method" value="put"> 
                       <input type="hidden" name="product_id" value="{{$product->id}}"> 
                    @endif

                <div class="form-group col-md-12">
                  <label for="title">Product Title</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title" 
                  required value="{{ (!is_null($product)) ? $product->title : '' }}">
                </div>

                 <div class="form-group col-md-12">
                  <label for="description">Product description</label>
                 <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ (!is_null($product)) ? $product->description : ''  }}</textarea>
                </div>

                 <div class="form-group col-md-12">
                  <label for="product_category">Product Category</label>
                   <select class="form-control" name="category_id" id="category_id" required>
                    <option>Select a Category</option>
                     @foreach ($categories as $category)
                      <option value="{{$category->id}}" 
                            {{ (! is_null($product) && ($product->category->id === $category->id)) ? 'selected' : ''}}
                        >{{ $category->name }}</option>
                     @endforeach
                    </select> 
                </div>
                
                <div class="form-group col-md-12">
                    <label for="product_unit">Product Unit</label>
                    <select class="form-control" name="unit" id="unit" required>
                        <option>Select a Unit</option>
                        @foreach ($units as $unit)
                        <option value="{{$unit->id}}" 
                                {{ (! is_null($product) && ($product->hasUnit->id === $unit->id)) ? 'selected' : ''}}
                            >{{ $unit->formatedName() }}</option>
                        @endforeach

                    </select> 
                    </div>

                <div class="form-group col-md-6">
                  <label for="price">Product Price</label>
                  <input type="number" step="any" class="form-control" name="price" id="price" placeholder="Product Price" 
                  required value="{{ (!is_null($product)) ? $product->price : '' }}">
                </div>

                 <div class="form-group col-md-6">
                  <label for="discount">Product discount</label>
                  <input type="number" class="form-control" name="discount" id="discount" placeholder="Product discount" 
                  required value="{{ (!is_null($product)) ? $product->discount : 0 }}">
                </div>

                <div class="form-group col-md-12">
                  <label for="product_total">Product Total</label>
                  <input type="number" class="form-control" step="any" name="total" id="total" placeholder="Product Total" 
                  required value="{{ (!is_null($product)) ? $product->total : '' }}">
                </div>

                {{-- Options --}}
                <div class="form-group col-md-12"> 
                    <table class="table table-striped" id="options-table">
                          @if (!is_null( $product ))
                            @if (!is_null( $product->jsonOptions() ))
                                @foreach ($product->jsonOptions() as $optionName => $options)
                                   @foreach ($options as $option)
                                       
                                <tr>
                                  <td>
                                      {{ $optionName }}
                                  </td>    
                                    
                                  <td>
                                     {{ $option }}
                                  </td>
                                  <td>
                                      <a href="" class="remove-option"><i class="fas fa-minus-circle"></i></a>
                                     <input type="hidden" name =" {{ $optionName }}[]" value =" {{ $option }} " >
                                  </td>
                                </tr>
                                  @endforeach

                                  <td><input type="hidden" name = "options[]" value = "{{ $optionName }}" ></td>

                                @endforeach
                            @endif    
                          @endif
                          
                    </table>
                  <a href="#" class="btn btn-outline-dark add-option-btn">Add Options</a>
                </div>

              <div class="form-group col-md-12">

                <div class="row">

                  @for ($i = 0; $i < 6; $i++)
                    <div class="col-md-4 col-sm-12 mb-4"> 
                      <div class="card image-card-upload">
                         @if (  !is_null($product) &&  ! is_null($product->images) && count($product->images) > 0 )
                                @if ( isset($product->images[$i]) && ! is_null($product->images[$i]) && !empty($product->images[$i]) )

                            <a href="" class="remove-image-upload" data-imageid="{{ $product->images[$i]->id }}" 
                              data-fileid="image-{{ $i }}"
                               data-removeimg="removeimg-{{ $i }}">
                               <i class="fas fa-minus-circle"></i>
                            </a>
                                @else 
                                <a href="" class="remove-image-upload" style="display: none" ><i class="fas fa-minus-circle"></i></a>

                                @endif
                              @endif
                            <a href="#" class="activate-image-upload" data-fileid="image-{{ $i }}" id="removeimg-{{ $i }}">
                        
                              @if (!is_null($product) && ! is_null($product->images) && count($product->images) > 0 )
                                @if ( isset($product->images[$i]) && ! is_null($product->images[$i]) && !empty($product->images[$i]) )

                                <img src="{{ asset("storage/".$product->images[$i]->url) }}" id="{{ 'iimage-'.$i }}" class="card-img-top">
                                @endif
                              @endif
                        
                            <div class="card-body" style="text-align: center">
                               @if (!is_null($product) && ! is_null($product->images) && count($product->images) > 0 )
                                @if ( isset($product->images[$i]) && ! is_null($product->images[$i]) && !empty($product->images[$i]) )
                                <i class="fas fa-image" style="display: none"></i>
                                @else 
                                <i class="fas fa-image"></i>
                                @endif
                                @else
                                <i class="fas fa-image"></i>
                              @endif
                        </div>
                      </a>
                      @if ( !is_null($product) && ! is_null($product->images) && count($product->images) > 0 )
                                @if ( isset($product->images[$i]) && ! is_null($product->images[$i]) && !empty($product->images[$i]) )
                               <input type="file" name="product_images[]" class="form-control-file image-file-upload" id="image-{{ $i }}" value="{{ asset("storage/".$product->images[$i]->url) }}"> 
                                @else 
                                <input type="file" name="product_images[]" class="form-control-file image-file-upload" id="image-{{ $i }}"> 
                                @endif
                                @else
                                <input type="file" name="product_images[]" class="form-control-file image-file-upload" id="image-{{ $i }}"> 
                              @endif
                      </div>
                    </div>
                  @endfor
                 
                </div>
              </div>   

    
                <div class="form-group col-md-6 offset-3">
                
                    <button type= "submit" class = "btn btn-primary btn-block">Save</button>

                </div>
            </form>
        </div>
       </div>
      </div>
     </div>     
    </div>

<div class="modal options-window" tabindex="-1" role="dialog" id="options-window">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Option</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
           <div class="modal-body">
           
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="option_name">Option Name</label>
                  <input type="text" class="form-control" name="option_name" id="option_name" placeholder="Option Name" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="option_value">Option</label>
                  <input type="text" class="form-control" name="option_value" id="option_value" placeholder="Option Value" required>
                </div>
              </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
        <button type="submit" class="btn btn-primary add-option-modal-button">ADD OPTION</button>
      </div>
   
    </div>
  </div>
</div>

<div class="modal image-window" tabindex="-1" role="dialog" id="options-window">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
           <div class="modal-body">
            <p>Are You Sure you want to delete this Image?</p>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
        <a href="#" type="submit" class="delete-image-btn btn btn-primary">DELETE IMAGE</a>
      </div>
   


    </div>
  </div>
</div>

@endsection



@section('scripts')

<script>
        var $optionsNameList = [];
</script>

  @if (!is_null($product))
      @if (!is_null($product->jsonOptions()))
          @foreach ($product->jsonOptions() as $optionName => $options)
              <script>$optionsNameList.push( '{{ $optionName }}' );</script>
          @endforeach
      @endif
  @endif

<script>

      $(document).ready(function(){
        var $optionWindow = $('#options-window');
        var $imagewindow = $('.image-window');
        var $optionBtn = $('.add-option-btn');
        var $optionsTable = $('#options-table');
        $optionBtn.on('click' , function(e){
            e.preventDefault();
            $optionWindow.modal('show');
        });


        //add options with modal
        $(document).on('click' , '.add-option-modal-button' , function(e){
            e.preventDefault();
             var $optionName = $('#option_name'); //get the value form modal input
          
             if($optionName.val() === ''){ //javascript validation
                    alert('Option Name is Required');
                    return false;
                }
             var $optionValue = $('#option_value');
              if($optionValue.val() === ''){
                    alert('Option Value is Required');
                    return false;
                }

              var optionsNameRow = '';
              if ( ! $optionsNameList.includes($optionName)) {
              
                  $optionsNameList.push( $optionName.val() );   
                
                   optionsNameRow = '<td><input type="hidden" name = "options[]" value = "'+ $optionName.val() +'" ></td>';
              }  


            var optionRow = `
                <tr>
                    <td>
                        `+ $optionName.val() +`
                    </td>    

                    <td>
                        `+ $optionValue.val() +`
                    </td>
                    <td>
                        <a href="" class="remove-option"><i class="fas fa-minus-circle"></i></a>
                         <input type="hidden" name =" `+ $optionName.val() +`[]" value =" ` + $optionValue.val() + ` " >
                    </td>
                </tr>`; 

                $optionsTable.append(
                    optionRow
                );
                $optionsTable.append(
                    optionsNameRow
                );

                $optionName.val('');
                $optionValue.val('');
               $optionWindow.modal('hide');

        });

        $(document).on('click','.remove-option' , function(e){
            e.preventDefault();
            $(this).parent().parent().remove(); //parent 1 is <td> and parent 2 is <tr>
        });
        //end options


        //upload images
          //function read the image only
          function readUrl(input , imageID)
          {
            if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload  = (function(e) {
                 $('#'+ imageID).attr('src' , e.target.result);
               });

               reader.readAsDataURL(input.files[0]); 
            }
          }
          

          function resetFileUpload(fileUploadID , imageID , $el , $ed) {
            $('#'+imageID).attr('src' , '');
            $el.fadeIn();
            $ed.fadeOut();
            // $('#'+fileUploadID).val(''); //by jquery
             var element = document.getElementById(fileUploadID); //by javascript
             element.value = '';
          }



          var $activateImageUpload = $('.activate-image-upload');

          $activateImageUpload.on('click' , function(e){
            e.preventDefault();
            var anchor = $(this); // get the anchor tag to from image
            var fileUploadID = $(this).data('fileid');
             $("#" + fileUploadID).trigger('click');
                var imagetag = '<img  id="i'+ fileUploadID +'"  src="" class = " card-img-top">';
                $(this).append(imagetag);
              
              $("#" + fileUploadID).on('change' , function(e){

                      readUrl(this , 'i' + fileUploadID);
                      anchor.find('i').fadeOut();
                      var $removeThisImage = anchor.parent().find('.remove-image-upload'); 
                      $removeThisImage.fadeIn();
                      $removeThisImage.on('click',function(e){
                        e.preventDefault();
                        resetFileUpload(fileUploadID ,'i' + fileUploadID ,anchor.find('i') ,$removeThisImage );
                      });


              });

          });

          $('.remove-image-upload').on('click' , function(e){
             e.preventDefault();
             var anchor = $(this);
             var imageId = anchor.data('imageid');
             var removeID  = $(this).data('removeimg');
             var fileUploadID = $(this).data('fileid');
             var $removeThisImage = anchor.parent().find('.remove-image-upload'); 

            $('.delete-image-btn').data('ed' ,$removeThisImage );
            $('.delete-image-btn').data('fileid' ,fileUploadID );
            $('.delete-image-btn').data('removeimg' ,removeID );
            $('.delete-image-btn').data('imageid' , imageId);
            $imagewindow.modal('show');

          });



      $(document).on('click', '.delete-image-btn' , function(e){
        e.preventDefault();
        var imageId = $(this).data('imageid');
        var removeID = $(this).data('removeimg');
        var fileUploadID = $(this).data('fileid');
        var ed = $(this).data('ed');
  
        resetFileUpload(fileUploadID ,'i' + fileUploadID , $('#'+ removeID).find('i')  ,ed );

        $.ajaxSetup({
        
            headers: {
            
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            
              }});

        $.ajax({
              url : "{{route('delete-image')}}",
              data : {
                image_id : imageId, 
              },
              dataType: 'json',
               method: 'POST',
               
            });
             $imagewindow.modal('hide');
        });    
        //end upload images
      });

</script>
    
@endsection