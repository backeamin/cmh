@extends('layouts.admin_layout')
@section('page_title')
    Khat
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h4 class="m-0">Khat List</h4>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#khat-modal"><i class="fe-plus"></i> New Khat</button>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr>
                            <td>SL</td>
                            <td>Title</td>
                            <td>Type</td>
                            <td>Action</td>
                        </tr>
                        @forelse($khats as $khat)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$khat->title}}</td>
                                <td>{{$khat->type == 1 ? 'Income' : 'Expense'}}</td>
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btn btn-outline-primary text-center waves-effect waves-light" data-toggle="modal" data-target="#edit_{{$khat->id}}"><i class="fe-edit"></i> Edit</a>

                                            <form action="{{route('khat.destroy', $khat->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to Delete This Book Shop?')" class="dropdown-item btn btn-outline-danger text-center"><i class="fe-trash"></i> Delete</button>
                                            </form>

                                        </div>
                                    </div>
                                    {{--edit modal--}}
                                    <div id="edit_{{$khat->id}}" class="modal fade text-left" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="m-0">
                                                        Update Khat
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" action="{{route('khat.update', $khat->id)}}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="title">Title</label>
                                                            <input value="{{$khat->title}}" class="form-control" type="text" name="title" id="title" placeholder="Title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="type">Type</label>
                                                            <select class="form-control" name="type" id="type">
                                                                <Option {{$khat->type == 1 ? 'selected' : ''}} value="1">Income</Option>
                                                                <Option {{$khat->type == 2 ? 'selected' : ''}} value="2">Expense</Option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group account-btn text-center">
                                                            <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Update Khat</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100">No Data Found!</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                <!-- Signup modal content -->
                <div id="khat-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="m-0">
                                    Create a New Khat
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="{{route('khat.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input class="form-control" type="text" name="title" id="title" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select class="form-control" name="type" id="type">
                                            <Option selected value="1">Income</Option>
                                            <Option value="2">Expense</Option>
                                        </select>
                                    </div>
                                    <div class="form-group account-btn text-center">
                                        <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Create Khat</button>
                                    </div>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->


            </div><!-- end col -->
        </div>
@endsection
