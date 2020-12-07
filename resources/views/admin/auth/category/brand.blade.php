@extends('admin.admin_layout')

@section('admin_content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{route('admin.home')}}">Admin</a>
            <a class="breadcrumb-item" href="{{route('brands.index')}}">Brand</a>

        </nav>
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Brand Table</h5>

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
                @endif {{----For displaying error validation----}}

                <div class="table-wrapper">

                    {{--          Pagination for id="datatable1"          --}}
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">Sl </th>
                            <th class="wd-20p">Brand Name</th>
                            <th class="wd-20p">Brand Logo</th>
                            <th class="wd-15p">Action</th>

                        </tr>
                        </thead>
                        @foreach($brands as $key=>$brand)
                            <tbody>
                            <tr>
                                <td>{{$key +1}}</td>
                                <td>{{$brand->brand_name}}</td>
                                <td><img src="{{asset($brand->brand_logo)}}" alt="brand logo" width="80"></td>
                                <td>
                                    <a id="" href="{{route('brands.edit',$brand->id)}}" class="btn btn-info sm">Edit</a>
                                    <a href="">
                                        <form id="form" class="form form-check-inline" action="{{route('brands.destroy',$brand->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a id="delete" data-action="{{route('brands.destroy',$brand->id)}}" class="btn text-white btn-danger ">Delete</a>
                                        </form>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->



        </div><!-- sl-pagebody -->
    </div>

    <!-- LARGE MODAL -->
    <div id="modaldemo" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add a new Brand</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="{{route('brands.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="brand">Brand Name</label>
                            <input type="text" name="brand_name" class="form-control"   placeholder="Enter brand name">
                        </div>
                        <div class="form-group">
                            <label for="brand logo">Brand logo</label>
                            <input type="file" name="brand_logo" class="form-control-file" >
                        </div>
                    </div> <!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                    </div><!-- modal-footer-->
                </form>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->

@endsection
