@extends('layouts.app')

@section('content')

    <div class="container">
  <div class="row">
      <div class="col-md-12">
          <h3>Units</h3>
            <div class="card">
                <div class="card-header">Units</div>
                  <div class="card-body">
                    <div class="ml-2">
                    <form action="{{ route('unit.store') }}" method="POST" class="row">
                          @csrf
                              <div class="form-group col-md-6">
                                <label for="unit_name">Unit Name</label>
                                <input type="text" class="form-control" name="unit_name" id="unit_name" placeholder="Unit Name" required>
                              </div>

                              <div class="form-group col-md-6">
                                <label for="unit_code">Unit Code</label>
                                <input type="text" class="form-control" name="unit_code" id="unit_code" placeholder="Unit Code" required>
                              </div>

                              <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Save New Unit</button>
                              </div>
                        </form>
                      </div>

                  <div class="row">
                     @foreach ($units as $unit)
                      <div class="col-md-3">
                        <div class="alert alert-primary">
                          <span class="buttons-span">
                            <span><a title="Edit" class="edit-unit" data-unitid ="{{$unit->id}}"
                                data-unitname ="{{$unit->unit_name}}"
                                data-unitcode ="{{$unit->unit_code}}">
                                <i class="fas fa-edit"></i></a>
                          </span>
                            
                          <span><a title="Delete" class="delete-unit" 
                                data-unitname ="{{$unit->unit_name}}"
                                data-unitcode ="{{$unit->unit_code}}"
                                data-unitid ="{{$unit->id}}"  >
                                <i class="fas fa-trash-alt"></i></a>
                            </span>
                          </span>
                          
                          <p>{{$unit->unit_name}},{{$unit->unit_code}}</p>
                        </div>
                    </div>   
                      @endforeach
                    </div>
                    
                    {{(! is_null($showLinks) && $showLinks ) ? $units->links() : ''}}


                  <form action="{{route('unit.search')}}" method="GET">  
                      @csrf
                      <div class="row">
                        <div class="form-group col-md-6">
                          <input type="text" class="form-control" name="unit_search" id="unit_search" placeholder="unit Search" required>
                        </div>
                        <div class="form-group col-md-6">
                          <button type="submit" class="btn btn-primary">SEARCH</button>
                        </div>
                      </div>
                  </form>

                  </div>
                </div>
               </div>
            </div>
         </div>

  @if (Session::has('message'))
      <div class="toast" style="position: absolute; z-index: 99999; top: 5%; right: 5%; background-color:blanchedalmond">
        <div class="toast-header">
          <strong class="mr-auto">Units</strong>
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


<!-- edit Modal -->  
  <div class="modal edit-window" tabindex="-1" role="dialog" id="edit-window">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{ route('unit.update') }}" method="POST">
           <div class="modal-body">
            @csrf
            {{method_field('PUT')}}
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="unit_name">Unit Name</label>
                  <input type="text" class="form-control" name="unit_name" id="edit_unit_name" placeholder="Unit Name" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="unit_code">Unit Code</label>
                  <input type="text" class="form-control" name="unit_code" id="edit_unit_code" placeholder="Unit Code" required>
                </div>

                <input type="hidden" name="unit_id" id="edit_unit_id">
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- delete Modal -->  
<div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('unit.delete')}}" method="POST" style="position: relative">
      <div class="modal-body">
        <p id="delete-message"></p>
            @csrf
            {{ method_field('DELETE') }}
            <input type="hidden" name="unit_id" value="" id="unit_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
            <button type="submit" class="btn btn-primary">Delete</button>
          </div>
        </form>
    </div>
  </div>
</div>


@section('scripts')

<script>

$(document).ready(function(){

     //edit script
    var $editUnit = $('.edit-unit');
    var $editWindow = $('#edit-window');
   
    var $edit_unit_name = $('#edit_unit_name');
    var $edit_unit_code = $('#edit_unit_code');
    var $edit_unit_id = $('#edit_unit_id');
    
    $editUnit.on('click' , function(element){
      element.preventDefault();
      var unit_name = $(this).data('unitname');
      var unit_code = $(this).data('unitcode');
      var unit_id = $(this).data('unitid');
       $edit_unit_name.val(unit_name);
       $edit_unit_code.val(unit_code);
       $edit_unit_id.val(unit_id);

      $editWindow.modal('show');

    });

    
   //delete script
    var $deletUnit = $('.delete-unit');
    var $deleteWindow = $('#delete-window');
    var $unitid = $('#unit_id');
    var $deletMessage = $('#delete-message');

    $deletUnit.on('click' , function(element){
    element.preventDefault();
    var unit_id = $(this).data('unitid');
    var unit_name = $(this).data('unitname');
    var unit_code = $(this).data('unitcode');
    $unitid.val(unit_id);
    $deletMessage.text('Are You Sure you want to delete ' + unit_name + ' with code ' + unit_code +' ?');  
    $deleteWindow.modal('show');
    //end delete script  

  });

});

</script>


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