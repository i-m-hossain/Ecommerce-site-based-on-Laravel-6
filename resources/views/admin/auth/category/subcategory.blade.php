@extends('admin.admin_layout')

@section('admin_content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{route('admin.home')}}">Admin</a>
            <a class="breadcrumb-item" href="{{route('subcategories.index')}}">Subcategory</a>

        </nav>
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Subcategory Table</h5>

            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Subcategory List
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
                <div class="table-wrapper">
                    {{--          Pagination for id="datatable1"          --}}
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">Sl </th>
                            <th class="wd-20p">Subcategory Name</th>
                            <th class="wd-20p">Category Name</th>
                            <th class="wd-15p">Action</th>

                        </tr>
                        </thead>
                        @foreach($subcategories as $key=>$subcategory)
                            <tbody>
                            <tr>
                                <td>{{$key +1}}</td>
                                <td>{{$subcategory->subcategory_name}}</td>
                                <td>{{$subcategory->category->category_name}}</td>
                                <td>
                                    <a id="" href="{{route('subcategories.edit',$subcategory->id)}}" class="btn btn-info sm">Edit</a>

                                    <form id="form" class="form-check-inline" action="{{route('subcategories.destroy',$subcategory->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a  id="delete" data-action="{{route('subcategories.destroy',$subcategory->id)}}" class="btn btn-danger text-white sm">Delete</a>
                                    </form>
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
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add new Subcategory</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="{{route('subcategories.store')}}">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="Subcategory">Subcategory Name</label>
                            <input type="text" name="subcategory_name" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Subcategory name">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category_id" id="">
                                @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                @endforeach
                            </select>

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
