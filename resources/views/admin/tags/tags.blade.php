@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Tags</h3>
            <div class="card">
                <div class="card-header">Tags</div>
                  <div class="card-body">
                    <div class="ml-2">
                     <form action="{{ route('tag.store') }}" method="POST" class="row">
                          @csrf
                              <div class="form-group col-md-6">
                                <label for="tag">Tag Name</label>
                                <input type="text" class="form-control" name="tag" id="tag" placeholder="Tag" required>
                              </div>

                              <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Save New Tag</button>
                              </div>
                        </form>
                      </div>

                    <div class="row">
                     @foreach ($tags as $tag)
                      <div class="col-md-3">
                        <div class="alert alert-primary">
                          <span class="buttons-span">
                            <span><a title="Edit" class="edit-tag" 
                            data-tagid ="{{$tag->id}}"
                            data-tag ="{{$tag->tag}}">
                            <i class="fas fa-edit"></i></a>
                          </span>
                            
                          <span><a title="Delete" class="delete-tag" 
                                data-tag ="{{$tag->tag}}"
                                data-tagid ="{{$tag->id}}"  >
                                <i class="fas fa-trash-alt"></i></a>
                            </span>
                          </span>

                            <p>{{$tag->tag}}</p>
                        </div>
                    </div>   
                      @endforeach
                  
                  </div>
                    {{ (!is_null($showLinks) && $showLinks) ? $tags->links() : '' }}

                     <form action="{{route('tag.search')}}" method="GET">  
                      @csrf
                      <div class="row">
                        <div class="form-group col-md-6">
                          <input type="text" class="form-control" name="tag_search" id="tag_search" placeholder="unit Search" required>
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
         </div>

    @if (Session::has('message'))
        <div class="toast" style="position: absolute; z-index: 99999; top: 5%; right: 5%; background-color:blanchedalmond">
        <div class="toast-header">
          <strong class="mr-auto">Tags</strong>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="toast-body">
          <span style="">{{ Session::get('message') }}</span>
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
        <h5 class="modal-title">Edit Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{ route('tag.update') }}" method="POST">
           <div class="modal-body">
            @csrf
            {{method_field('PUT')}}
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="tag">Tag</label>
                  <input type="text" class="form-control" name="tag" id="edit_tag" placeholder="Tag Name" required>
                </div>

                <input type="hidden" name="tag_id" id="edit_tag_id">

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
        <h5 class="modal-title">Delete Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('tag.delete')}}" method="POST" style="position: relative">
      <div class="modal-body">
        <p id="delete-message"></p>
            @csrf
            {{ method_field('DELETE') }}
            <input type="hidden" name="tag_id" value="" id="tag_id">
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
  var $editTag = $('.edit-tag');
  var $editWindow = $('#edit-window');

  var $edit_tag = $('#edit_tag');
  var $edit_tag_id = $('#edit_tag_id');

  $editTag.on('click' , function(element) {
    element.preventDefault();

    var tag_id = $(this).data('tagid');
    var tag_name = $(this).data('tag');
    $edit_tag_id.val(tag_id);
    $edit_tag.val(tag_name);
    
    $editWindow.modal('show');

  });

  //delete script
  var $deleteTag = $('.delete-tag');
  var $deletewindow = $('#delete-window');
  var $tagid = $('#tag_id');
  var $deletMessage = $('#delete-message'); 

  $deleteTag.on('click' , function(element) {
    element.preventDefault();
    var tag_id = $(this).data('tagid');
    var tag = $(this).data('tag');
     $tagid.val(tag_id);
     
    $deletMessage.text('Are you sure you want to delete ' + tag + ' tag');
    $deletewindow.modal('show');
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