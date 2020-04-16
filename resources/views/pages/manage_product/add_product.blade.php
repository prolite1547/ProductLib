@extends('layouts.master')
@section('title', 'Product Library - Manage Product')
@section('main_content')
{!! Form::open(['method' => 'POST','route' => 'addproduct.add','id' => 'form-addProduct']) !!}
   <div class="container">
        <div class="row">
                <div class="col-md-8">
                        <h3>Product Details</h3>
                        <div class="form-group row">
                                <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                                 <input type="text" name="barcode" class="form-control input__text" placeholder="Search EBS barcode" aria-label="EBS Barcode" aria-describedby="basic-addon2" id="ebs_input" required>
                                                <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" id="btnGetDetails" type="button">SEARCH</button>   
                                                </div>       
                                        </div>
                                        <div class="invalid-feedback">
                                                Please enter a message in the textarea.
                                        </div>
                                         
                                </div>
                        </div>
                        
                     
                      
                        <div class="form-group row">
                                <div class="col-sm-10">
                                        <label for="description">Item Description</label>
                                        <input type="text" name="description" class="input__info form-control" readonly id="description"  placeholder="">
                                </div>
                        </div>
                    
                        <div class="form-group row">  
                                <div class="col-sm-5">
                                        <label for="legacy_barcode">Legacy Barcode</label>
                                        <input type="text" name="legacy_barcode" class="input__info form-control" readonly id="legacy_barcode"  placeholder="">
                                </div>
                                <div class="col-sm-5">
                                        <label for="supplier">Supplier</label>
                                        <input type="text" name="supplier" class="input__info form-control" id="supplier" readonly placeholder="">
                                </div>
                        </div>
        
                        <div class="form-group row">  
                                <div class="col-sm-5">
                                        <label for="brand">Brand</label>
                                        <input type="text" name="brand" class="input__info form-control" readonly id="brand" placeholder="">
                                </div>
                                <div class="col-sm-5">
                                        <label for="division">Division</label>
                                        <input type="text" name="division" class="input__info form-control" id="division" readonly placeholder="">
                                </div>
                        </div>
        
                        <div class="form-group row">  
                                <div class="col-sm-5">
                                        <label for="department">Department</label>
                                        <input type="text" name="department" class="input__info form-control" readonly id="department" placeholder="">
                                </div>
                                <div class="col-sm-5">
                                        <label for="categ">Category</label>
                                        <input type="text" name="category" class="input__info form-control" id="categ" readonly placeholder="">
                                </div>
                        </div>
        
                        <div class="form-group row">  
                                <div class="col-sm-5">
                                        <label for="sub_categ">Sub-Category</label>
                                        <input type="text" name="sub_category" class="input__info form-control" readonly id="sub_categ" placeholder="">
                                </div>
                                <div class="col-sm-5">
                                        <label for="status">Status</label>
                                        <input type="text" name="status" class="input__info form-control" readonly id="status" placeholder="">
                                </div>
                        </div>
        
                        <div class="form-group row">  
                              
                                <div class="col-sm-5">
                                        <label for="material">Material</label>
                                        <input type="text" name="material" class="input__info form-control" id="material" readonly placeholder="">
                                </div>
        
                                <div class="col-sm-5">
                                        <label for="dimension">Dimension</label>
                                        <input type="text" name="dimension" class="input__info form-control" readonly id="dimension" placeholder="">
                                </div>
                        </div>
        
                        <div class="form-group row">  
                                <div class="col-sm-5">
                                        <label for="code">Code</label>
                                        <input type="text" name="code" class="input__info form-control" readonly id="code" placeholder="">
                                </div>
                                <div class="col-sm-5">
                                        <label for="finish_color">Finish/Color</label>
                                        <input type="text" name="finish_color" class="input__info form-control" id="finish_color" readonly placeholder="">
                                </div>
                        </div>
                         
                    </div>
            
                <div class="col-md-4">
                        <div class="form-group row">
                                <img src="{{ asset('images/no-image.svg') }}" data-img_def="{{ asset('images/no-image.svg') }}" class="img-fluid" id="productImg" data-toggle="tooltip" data-placement="right" title="Click to upload image">
                                <input type="file" name="image_choice" id="image_choice" accept="image/png, image/jpeg" required>
                                {{-- <img src="{{ asset('images/no-image.svg') }}" class="rounded mx-auto d-block" alt=""> --}}
                        </div>
        
                        <div class="form-group row">
                                <label for="features">Features</label>
                                <textarea name="feature" class="form-control input__text-area" id="features" cols="10" rows="5"></textarea>
                        </div>
        
                        <div class="form-group row">
                                <label for="benefits">Benefits</label>
                                <textarea name="benefits" class="form-control input__text-area" id="benefits" cols="10" rows="5"></textarea>
{{--          
                                {!! Form::hidden('ebs_msi_updated_at', null, ['id'=>'msib_update_date']) !!}
                                {!! Form::hidden('ebs_ic_updated_at', null, ['id'=>'cat_update_date']) !!}
                                {!! Form::hidden('ebs_msi_updated_by', null, ['id'=>'ebs_msi_updated_by']) !!} --}}
                                {!! Form::hidden('last_update_date', null, ['id'=>'last_update_date']) !!} 
                                {!! Form::hidden('last_update_by', null, ['id'=>'last_update_by']) !!} 
                                {!! Form::hidden('user_id', Auth::user()->id , []) !!}
                                {!! Form::hidden('updated_by', Auth::user()->id, []) !!}
                        </div>
        
                        <div class="form-group row">
                                <button class="btn btn-sm btn-danger" type="submit" id="btnAddProduct" disabled>ADD PRODUCT</button>
                        </div>
                </div>
        </div>
   </div>
 
@endsection
