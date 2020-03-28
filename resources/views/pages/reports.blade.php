@extends('layouts.master')
@section('title', 'Product Library - Products')
@section('main_content')
    <div class="row">
        <div class="col-md-12">
                
            {!! Form::open(['method' => 'POST','route' => 'gen.report','id' => 'form-genReport']) !!}
                <div class="card report_params">
                    <div class="card-header bg-dark text-light">
                      Product Report Parameters
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" name="barcode" class="input__text form-control"   id="barcode"  placeholder="EBS barcode">
                            </div>
                            <div class="col-md-5">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="input__text form-control"   id="description"  placeholder="item description">
                           </div>
                           <div class="col-md-5">
                                <label for="brand">Brand</label>
                                {!! Form::select('brand[]', [] , null, ['class'=>'brandSelect2 form-control']) !!}
                           </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="description">Dimension</label>
                                {!! Form::select('dimension[]', [] , null, ['class'=>'dimensionSelect2 form-control']) !!}
                           </div>

                           <div class="col-md-4">
                            <label for="itemstatus">Item Status</label>
                                 {!! Form::select('status', ['Active'=>'Active','Inactive'=>'Inactive'] , null, ['class'=>'itemStatusSelect2 form-control']) !!}
                             </div>

                             <div class="col-md-4">
                                <label for="description">Printing Details</label>
                                     {!! Form::select('printing_details[]', ['All'=>'All','Brand'=>'Brand','Description'=>'Description', 'Dimensions'=>'Dimensions', 'Code'=>'Code','Feature'=>'Feature', 'Benefits'=>'Benefits'] , null, ['class'=>'printDetailsSelect2 form-control', 'required']) !!}
                                </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-danger btn-sm float-right">Generate Report</button>
                            </div>
                        </div>

                    </div>
                </div>
 
        </div>
        
    </div>

    
    <div class="reportResult mt-5">
                  
    </div>

  
    <a href="#" title="Print" class="float bg-dark">
        <i class="fa fa-print my-float"></i>
    </a>
 
@endsection
