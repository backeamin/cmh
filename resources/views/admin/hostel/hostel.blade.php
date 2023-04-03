@extends('layouts.admin_layout')
@section('page_title')
    Hostel
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h4 class="m-0">Hostel List</h4>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#user-modal"><i class="fe-plus"></i> New Hostel</button>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr>
                            <td>SL</td>
                            <td>Name</td>
                            <td>Profile Picture</td>
                            <td>Email</td>
                            <td>Phone Number</td>
                            <td>Role</td>
                            <td>Action</td>
                        </tr>
                        @forelse($users as $user)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$user->name}}</td>
                                <td><img style="height: 50px;" src="{{asset('storage')}}/{{$user->profile_pic}}" alt=""></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone_number}}</td>
                                <td>{{$user->role->role_name}}</td>
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btn btn-outline-primary text-center waves-effect waves-light" data-toggle="modal" data-target="#edit_{{$user->id}}"><i class="fe-edit"></i> Edit</a>

                                            <form action="{{route('user.destroy', $user->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to Delete This Book Shop?')" class="dropdown-item btn btn-outline-danger text-center"><i class="fe-trash"></i> Delete</button>
                                            </form>

                                        </div>
                                    </div>
                                    {{--edit modal--}}
                                    <div id="edit_{{$user->id}}" class="modal fade text-left" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="m-0">
                                                        Update Hostel
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" action="{{route('user.update', $user->id)}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input value="{{$user->name}}" class="form-control" type="text" name="name" id="name" placeholder="Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input value="{{$user->email}}" class="form-control" type="email" name="email" id="email" placeholder="Email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone_number">Phone Number</label>
                                                            <input value="{{$user->phone_number}}" class="form-control" type="text" name="phone_number" id="phone_number" placeholder="Phone Number">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="profile_pic">Profile Picture</label> <br>
                                                            <img style="margin: 5px 0; height: 50px;" src="{{asset('storage')}}/{{$user->profile_pic}}" alt="">
                                                            <input class="form-control" type="file" name="profile_pic" id="profile_pic">
                                                        </div>
                                                        <div class="form-group account-btn text-center">
                                                            <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Update Hostel</button>
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
                <div id="user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="m-0">
                                    Create a New Hostel
                                </h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input class="form-control" type="text" name="phone_number" id="phone_number" placeholder="Phone Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="profile_pic">Profile Picture</label>
                                        <input class="form-control" type="file" name="profile_pic" id="profile_pic">
                                    </div>
                                    <div class="form-group">
                                        <label for="role_id">Role</label>
                                        <select class="form-control" name="role_id" id="role_id">
                                            <Option selected value="2">Hostel</Option>
                                            <Option  value="3">Personal</Option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your password" required autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                                 </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">Confirm Password</label>
                                        <input id="password-confirm" type="password" placeholder="Retype your password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <div class="form-group account-btn text-center">
                                        <div class="row">
                                            <div class="col-6 text-right">
                                                <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Create Hostel</button>
                                            </div>
                                            <div class="col-6 text-left">
                                                <a class="btn btn-primary btn-rounded" href="{{route('user.index')}}">Back To Hostel List</a>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->


            </div><!-- end col -->
        </div>
@endsection
