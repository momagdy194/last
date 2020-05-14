    @extends('layouts.app')

    @section('content')

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Categories</h3>
                    <div class="card">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="ml-2">
                                <form action="{{ route('categories.store') }}" method="POST" class="row"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-md-6">
                                        <label for="tag">Category Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               placeholder="Category name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tag">Category Image</label>
                                        <input type="file" class="form-control-file" name="category_image"
                                               id="category_image" required>
                                    </div>

                                    {{--                         //redio Check--}}
                                    <div class="form-group col-md-6">
                                        <label for="tag">Category Dirction</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="image_direction"
                                                   id="exampleRadios1" value="left" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                                Left
                                            </label>
                                        </div>
                                        <div class="form-check" >
                                            <input class="form-check-input" type="radio" name="image_direction"
                                                   id="exampleRadios2" value="right">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Right
                                            </label>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">Save New Category</button>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                @foreach ($categories as $category)
                                    <div class="col-md-3">
                                        <div class="alert alert-primary">
                            <span class="buttons-span">
                                <span><a title="Edit" class="edit-category"
                                         data-categoryid="{{$category->id}}"
                                         data-name="{{$category->name}}">
                                <i class="fas fa-edit"></i></a>
                              </span>

                              <span><a title="Delete" class="delete-category"
                                       data-categoryid="{{$category->id}}"
                                       data-name="{{$category->name}}">
                                    <i class="fas fa-trash-alt"></i></a>
                                </span>
                            </span>
                                            <p>{{$category->name}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{ (!is_null($showLinks) && $showLinks) ? $categories->links() : '' }}

                            <form action="{{route('categories.search')}}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="category_search" id="category_search"
                                               placeholder="Category Search" required>
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
            <div>
                <div class="toast"
                     style="position: absolute; z-index: 99999; top: 5%; right: 5%; background-color:blanchedalmond">
                    <div class="toast-header">
                        <strong class="mr-auto">Categories</strong>
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
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('categories.update') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="tag">Category</label>
                                <input type="text" class="form-control" name="name" id="category_name"
                                       placeholder="Category Name" required>
                            </div>

                            <input type="hidden" name="category_id" id="edit_category_id">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
                    <h5 class="modal-title">Delete Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('categories.delete')}}" method="POST" style="position: relative">
                    <div class="modal-body">
                        <p id="delete-message"></p>
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="category_id" value="" id="category_id">
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

            $(document).ready(function () {


                //delete script
                var $deleteCategory = $('.delete-category');
                var $deleteWindow = $('#delete-window');
                var $categoryid = $('#category_id');
                var $deleteMessage = $('#delete-message');


                $deleteCategory.on('click', function (element) {
                    element.preventDefault();
                    var category_id = $(this).data('categoryid');
                    var category_name = $(this).data('name');
                    $categoryid.val(category_id);
                    $deleteMessage.text('Are You sure you want to delete ' + category_name + ' category?');
                    $deleteWindow.modal('show');

                });

                //edit script
                var $editCategory = $('.edit-category');
                var $editWindow = $('#edit-window');
                var $edit_category_name = $('#category_name');
                var $edit_category_id = $('#edit_category_id');

                $editCategory.on('click', function (element) {
                    element.preventDefault();
                    var category_id = $(this).data('categoryid');
                    var category_name = $(this).data('name');
                    $edit_category_name.val(category_name);
                    $edit_category_id.val(category_id);
                    $editWindow.modal('show');
                });

            });

        </script>


        @if (Session::has('message'))
            <script>

                $(document).ready(function () {
                    var $toast = $('.toast').toast({
                        autohide: false
                    });
                    $toast.toast('show');
                });

            </script>
        @endif
    @endsection
