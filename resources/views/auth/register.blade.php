@extends('layouts.auth_layout')

@section('page-title')
    Register
@endsection
@section('main-content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input id="fullname" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter your name" value="{{ old('name') }}" required autocomplete="name">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="form-group">
            <label for="emailaddress">Email address</label>
            <input id="emailaddress" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Enter your phone number" value="{{ old('phone_number') }}" required autocomplete="phone_number">

            @error('phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

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

        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);"
                        class="text-dark">Terms and Conditions</a></label>
            </div>
        </div>
        <div class="form-group mb-0 text-center">
            <button class="btn btn-gradient btn-block" type="submit"> Sign Up Free </button>
        </div>

    </form>

    <div class="row mt-4">
        <div class="col-sm-12 text-center">
            <p class="text-muted mb-0">Already have an account? <a href="{{ route('login') }}"
                    class="text-dark ml-1"><b>Sign In</b></a></p>
        </div>
    </div>
@endsection



