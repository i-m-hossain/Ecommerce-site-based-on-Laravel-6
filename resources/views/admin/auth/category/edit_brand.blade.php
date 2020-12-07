@extends('admin.admin_layout')

@section('admin_content')
    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit Brand</h5>

            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Brand List
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
                <form method="post" action="{{route('brands.update',$brand->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="brand">Brand Name</label>
                            <input type="text" name="brand_name" value="{{$brand->brand_name}}" class="form-control"  aria-describedby="emailHelp" >
                        </div>
                        <div class="form-group">
                            <label for="brand logo">Brand Logo</label>
                            <input type="file" name="brand_logo" value="{{$brand->brand_logo}}" class="form-control-file"  aria-describedby="emailHelp"">
                        </div>
                        <div class="form-group">
                            <label for="brand logo">Old Logo</label>
                            <img src="{{asset($brand->brand_logo)}}" alt="brand logo" width="80">
                            <input type="hidden" name="old_logo" value="{{$brand->brand_logo}}">

                        </div>
                    </div> <!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Update</button>
                        <a href="{{route('brands.index')}}"><button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button></a>
                    </div><!-- modal-footer-->
                </form>

            </div><!-- card -->



        </div><!-- sl-pagebody -->
    </div>


@endsection
