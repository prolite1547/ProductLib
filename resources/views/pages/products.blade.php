@extends('layouts.master')
@section('title', 'Product Library - Products')
@section('main_content')
 
    <div class="row">
        <div class="col-md-12">
            
            <table class="table  table-hover table-sm" id="table_products">
                <thead class="bg-dark">
                    <tr>
                        <th></th>
                        <th>Barcode</th>
                        <th>Legacy Barcode</th>
                        <th>Description</th>
                        <th>Supplier</th>
                        <th>Brand</th>
                        <th>Division</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                     
                </tbody>
            </table>
        </div>
    </div>
 
@endsection
