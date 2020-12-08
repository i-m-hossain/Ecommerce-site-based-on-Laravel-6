@extends('admin.admin_layout')

@section('admin_content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{route('admin.home')}}">Admin</a>
            <a class="breadcrumb-item" href="{{route('newsletter.index')}}">Coupon</a>

        </nav>
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Coupon Table</h5>

            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Subscriber list
                    <a href=""  class="btn float-right btn-sm btn-warning" data-toggle="modal" data-target="#modaldemo">Delete checked</a>
                </h6>

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
                            <th class="wd-15p">Subscriber Email </th>
                            <th class="wd-15p">Subscribing time </th>
                            <th class="wd-15p">Action</th>

                        </tr>
                        </thead>
                        @foreach($subs as $key=>$sub)
                            <tbody>
                            <tr>
                                <td><input type="checkbox" class="mr-2">{{$key +1}}</td>
                                <td>{{$sub->email}}</td>
                                <td>{{$sub->created_at->diffForHumans()}}</td>
                                <td>
                                    <form id="form" class="form-check-inline" action="{{route('newsletter.destroy',$sub->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a  id="delete" data-action="{{route('newsletter.destroy',$sub->id)}}" class="btn btn-danger text-white sm">Delete</a>
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

@endsection
