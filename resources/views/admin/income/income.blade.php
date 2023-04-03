@extends('layouts.admin_layout')
@section('page_title')
    Income
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h4 class="m-0">Income List</h4>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#income-modal"><i class="fe-plus"></i> New Income</button>

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
                        @forelse($incomes as $income)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$income->user->name}}</td>
                                <td>{{$income->title}}</td>
                                <td>{{$income->khat->title}}</td>
                                <td>{{$income->amount}}</td>
                                <td>{{$income->date}}</td>
                                <td><img style="height: 50px;" src="{{asset('storage')}}/{{$income->voucher}}" alt=""></td>
                                <td>{{$income->comment}}</td>
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btn btn-outline-primary text-center waves-effect waves-light" data-toggle="modal" data-target="#edit_{{$income->id}}"><i class="fe-edit"></i> Edit</a>

                                            <form action="{{route('income.destroy', $income->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to Delete This Book Shop?')" class="dropdown-item btn btn-outline-danger text-center"><i class="fe-trash"></i> Delete</button>
                                            </form>

                                        </div>
                                    </div>
                                    {{--edit modal--}}
                                    <div id="edit_{{$income->id}}" class="modal fade text-left" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="m-0">
                                                        Update Income
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" action="{{route('income.update', $income->id)}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="user_id">User Name</label>
                                                            <select class="form-control" name="user_id" id="khat_id">
                                                                <Option disabled>Select User</Option>
                                                                @foreach($users as $user)
                                                                    <option {{$user->id == $income->user_id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title">Title</label>
                                                            <input class="form-control" value="{{$income->title}}" type="text" name="title" id="title" placeholder="Title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="khat_id">Khat</label>
                                                            <select class="form-control" name="khat_id" id="khat_id">
                                                                <Option disabled>Select Khat</Option>
                                                                @foreach($khats as $khat)
                                                                    <option {{$khat->id == $income->khat_id ? 'selected' : ''}} value="{{$khat->id}}">{{$khat->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="voucher">Voucher (MAX:2MB)</label> <br>
                                                            <img style="margin: 5px 0; height: 50px;" src="{{asset('storage')}}/{{$income->voucher}}" alt="">
                                                            <input class="form-control" name="voucher" type="file" id="voucher">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="amount">Amount</label>
                                                            <input class="form-control" value="{{$income->amount}}" type="number" name="amount" id="amount" placeholder="Amount">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date">Date</label>
                                                            <input class="form-control" value="{{$income->date}}" type="date" name="date" id="date">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="comment">Comment</label>
                                                            <textarea class="form-control" name="comment" id="comment" cols="10" rows="5" placeholder="Comment">{{$income->comment}}</textarea>
                                                        </div>
                                                        <div class="form-group account-btn text-center">
                                                            <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Update Income</button>
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
                <div id="income-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="m-0">
                                    Create a New Income
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="{{route('income.store')}}" method="post" enctype="multipart/form-data">
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
                                        <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Create Income</button>
                                    </div>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->


            </div><!-- end col -->
        </div>
@endsection
