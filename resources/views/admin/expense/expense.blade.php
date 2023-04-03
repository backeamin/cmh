@extends('layouts.admin_layout')
@section('page_title')
    Expense
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h4 class="m-0">Expense List</h4>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#expense-modal"><i class="fe-plus"></i> New Expense</button>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr>
                            <td>SL</td>
                            <td>User Name</td>
                            <td>Title</td>
                            <td>Khat</td>
                            <td>Amount</td>
                            <td>Date</td>
                            <td>Voucher</td>
                            <td>Comment</td>
                            <td>Action</td>
                        </tr>
                        @forelse($expenses as $expense)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$expense->user->name}}</td>
                                <td>{{$expense->title}}</td>
                                <td>{{$expense->khat->title}}</td>
                                <td>{{$expense->amount}}</td>
                                <td>{{$expense->date}}</td>
                                <td><img style="height: 50px;" src="{{asset('storage')}}/{{$expense->voucher}}" alt=""></td>
                                <td>{{$expense->comment}}</td>
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btn btn-outline-primary text-center waves-effect waves-light" data-toggle="modal" data-target="#edit_{{$expense->id}}"><i class="fe-edit"></i> Edit</a>

                                            <form action="{{route('expense.destroy', $expense->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to Delete This Book Shop?')" class="dropdown-item btn btn-outline-danger text-center"><i class="fe-trash"></i> Delete</button>
                                            </form>

                                        </div>
                                    </div>
                                    {{--edit modal--}}
                                    <div id="edit_{{$expense->id}}" class="modal fade text-left" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="m-0">
                                                        Update Expense
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" action="{{route('expense.update', $expense->id)}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="user_id">User Name</label>
                                                            <select class="form-control" name="user_id" id="khat_id">
                                                                <Option disabled>Select User</Option>
                                                                @foreach($users as $user)
                                                                    <option {{$user->id == $expense->user_id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title">Title</label>
                                                            <input class="form-control" value="{{$expense->title}}" type="text" name="title" id="title" placeholder="Title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="khat_id">Khat</label>

                                                            <select class="form-control" name="khat_id" id="khat_id">
                                                                <Option disabled>Select Khat</Option>
                                                                @foreach($khats as $khat)
                                                                    <option {{$khat->id == $expense->khat_id ? 'selected' : ''}} value="{{$khat->id}}">{{$khat->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="voucher">Voucher (MAX:2MB)</label> <br>
                                                            <img style="margin: 5px 0; height: 50px;" src="{{asset('storage')}}/{{$expense->voucher}}" alt="">
                                                            <input class="form-control" name="voucher" type="file" id="voucher">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="amount">Amount</label>
                                                            <input class="form-control" value="{{$expense->amount}}" type="number" name="amount" id="amount" placeholder="Amount">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date">Date</label>
                                                            <input class="form-control" value="{{$expense->date}}" type="date" name="date" id="date">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="comment">Comment</label>
                                                            <textarea class="form-control" name="comment" id="comment" cols="10" rows="5" placeholder="Comment">{{$expense->comment}}</textarea>
                                                        </div>
                                                        <div class="form-group account-btn text-center">
                                                            <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Update Expense</button>
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
                <div id="expense-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="m-0">
                                    Create a New expense
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="{{route('expense.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="user_id">User Name</label>
                                        <select class="form-control" name="user_id" id="user_id">
                                            <Option selected disabled>Select User</Option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input class="form-control" type="text" name="title" id="title" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="khat_id">Khat</label>
                                        <select class="form-control" name="khat_id" id="khat_id">
                                            <Option selected disabled>Select Khat</Option>
                                            @foreach($khats as $khat)
                                                <option value="{{$khat->id}}">{{$khat->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="voucher">Voucher (MAX:2MB)</label>
                                        <input class="form-control" name="voucher" type="file" id="voucher">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input class="form-control" type="number" name="amount" id="amount" placeholder="Amount">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input class="form-control" type="date" name="date" id="date">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Comment</label>
                                        <textarea class="form-control" name="comment" id="comment" cols="10" rows="5" placeholder="Comment"></textarea>
                                    </div>
                                    <div class="form-group account-btn text-center">
                                        <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Create expense</button>
                                    </div>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->


            </div><!-- end col -->
        </div>
@endsection
