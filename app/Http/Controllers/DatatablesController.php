<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Product;
use DB;


 
class DatatablesController extends Controller
{     
     protected $conn;
     public function __construct()
     {
       
     }

     public function getProducts(){
          $query = DB::table('products as prd')
          ->leftjoin('product_images as prd_img','prd_img.product_id', 'prd.id')
          ->leftjoin('users as u', 'u.id', 'prd.user_id')
          ->leftjoin('users as u1', 'u1.id', 'prd.updated_by')
          ->select('prd.id','prd_img.path','prd.barcode','prd.legacy_barcode','prd.description','prd.supplier',
          'prd.brand','prd.division','prd.department','prd.category','prd.sub_category','prd.status',
          'prd.material','prd.code','prd.dimension',
          'prd.finish_color','prd.feature',
          'prd.benefits','prd.ebs_msi_updated_at',
          'prd.ebs_msi_updated_by','prd.ebs_ic_updated_at',
          'prd.created_at',
          'u.uname as created_by',
          'u1.uname as updated_by',
          'prd.updated_at'
          );
          return Datatables::of($query)->toJson();
     }

    
}
