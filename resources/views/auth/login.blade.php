@extends('layouts.app')
@section('title', 'Product Library - Log in')
@section('main_content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card" >
                <div class="card-header  bg-light text-dark">Note : </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                Login form is not available. <br> You may login via CitiHardware EBS Dashboard
                            </div>
                        </div>
                    </div>
                    {{--  <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="uname" class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                                <input id="uname" type="text" class="form-control @error('uname') is-invalid @enderror" name="uname" required autocomplete="email" autofocus>
                                @error('uname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>  --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
