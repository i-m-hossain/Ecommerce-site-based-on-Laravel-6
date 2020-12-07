@extends('admin.admin_layout')

@section('admin_content')
    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit Category</h5>

            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Category List
                    <a href=""  class="btn float-right btn-sm btn-warning" data-toggle="modal" data-target="#modaldemo">ADD NEW</a>
                </h6> <!-- Here I am using bootstrap Modal to add new category. The modal div is included at the last portion--->

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{route('categories.update',$category->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="category">Category Name</label>
                            <input type="text" name="category_name" value="{{$category->category_name}}" class="form-control"  aria-describedby="emailHelp" placeholder="Enter category name">
                        </div>
                    </div> <!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Update</button>
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                    </div><!-- modal-footer-->
                </form>

            </div><!-- card -->



        </div><!-- sl-pagebody -->
    </div>


@endsection
