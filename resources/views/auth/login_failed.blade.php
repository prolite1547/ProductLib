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
                                Access denied by page security check. <br> Please contact IT Support
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
