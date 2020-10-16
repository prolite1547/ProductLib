<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
use App\Product;
use App\ProductImage;
use Illuminate\Support\Facades\Storage;
use DB;
// use Alert;

class ProductController extends Controller
{ 
  protected $conn;
  public function __construct()
    {     $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_CASE => PDO::CASE_LOWER,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM,
            ];
        /*Oracle*/
        $myServer = '';
        $myDB = '';
        $oci_uname = '';
        $oci_pass = '';
        $tns = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$myServer.")(PORT = 1521)))(CONNECT_DATA=(SID=".$myDB.")))";
        try {
            $this->conn = new PDO("oci:dbname=".$tns. ';charset=UTF8', $oci_uname, $oci_pass,$options);
            
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
      
  }
  
  public function getProductDetails($barcode){
    // Alert::success('Success Message', 'Optional Title');
      $query = "SELECT
                MSI.BARCODE as barcode,
                MSI.LEGACYBARCODE as LEGACY_BARCODE,
                -- MSI.LEGACY_BARCODE,
                MSI.DESCRIPTION,
                MSI.BRANDNAME as brand,
                AP.VENDOR_NAME as supplier,
                MSI.DIVISIONNAME as division,
                MSI.DEPARTMENTNAME as department,
                MSI.CATEGORYNAME as categ,
                MSI.SUBCATEGORYNAME as sub_categ,
                -- MSI.STATUS,
                MSI.INVENTORY_ITEM_STATUS_CODE as status,
                MSI.MATERIALNAME as material,
                MSI.DIMENSIONNAME as dimension,
                MSI.FINISHCOLORNAME as finish_color,
                MSI.MODELFRMSUPPLIERNAME as code,
                TO_CHAR(MSI.LAST_UPDATE_DATE, 'dd-MON-YY hh24:mi:ss') as last_update_date,
                MSI.LAST_UPDATED_BY as last_update_by
              --  TO_CHAR(MSIB_LAST_UPDATE_DATE, 'dd-MON-YY hh24:mi:ss') as msib_update_date,
              --  TO_CHAR(MSI.CAT_UPDATE_DATE, 'dd-MON-YY hh24:mi:ss') as cat_update_date,
              --  MSIB_LAST_UPDATE_BY as ebs_msi_updated_by
                FROM 
                XXCH_MTLCAT_PRODUCT_V MSI,
                APPS.AP_SUPPLIERS AP
                --  DWT_DIM_PRODUCT MSI,
                --  XXCH_PRODUCT_LISTING_V MSI,
                -- XXCH_PRODUCT_LISTING_DEV_V  MSI,
                --DWT_DIM_EX_SUPPLIER  AP 
                WHERE 
                AP.SEGMENT1 = MSI.VENDORCODE AND 
                MSI.BARCODE = '$barcode' AND ROWNUM = 1";
      $stmt = $this->conn->prepare($query);
      if($stmt->execute()){
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return response()->json($result, 200);
      }
  }

  public function addProduct(Request $request){
  
    $validation = [
      'barcode' => 'required|string',
      'image_choice' => 'required|image|mimes:jpeg,png',
      'features' => 'required|string',
      'benefits' => 'required|string',
    ];
    $request->validate($validation);
    if(Product::whereNull('deleted_at')->where('barcode', '=', $request->barcode)->count() > 0){
          return response()->json(array('success'=> false, 'response'=> 'Product already exist, you can check the product list.'), 200);
    }

    if($request->hasFile('image_choice')){
      $image = $request->image_choice;
      $original_name = $image->getClientOriginalName();
      if(ProductImage::whereNull('deleted_at')->where('original_name', '=', $original_name)->count() > 0){
        return response()->json(array('success'=> false, 'response'=> 'Product image already exist, you can check the product list.'), 200);
      }
    }
   $response = array('success'=> false, 'response'=>'An error occured while inserting data..');
   $response =  DB::transaction(function () use ($request){
      // $request->merge(['feature'=> nl2br($request->feature), 'benefits'=> nl2br($request->benefits)]);
      $product = Product::create($request->except('_token'));
      if($product->id){
        $productImgDirectoryName = str_replace(':', '', preg_replace('/[-,\s]/', '_', $product->created_at)) . '_' .  $product->id;
        if($request->hasFile('image_choice')){
            $image = $request->image_choice;
            $original_name = $image->getClientOriginalName();
            $mime_type = $image->getMimeType();
            $original_ext = $image->getClientOriginalExtension();
            $path =  $image->store("$productImgDirectoryName", 'productimages');
            ProductImage::create(['product_id' => $product->id, 'path' => $path, 'original_name' => $original_name, 'mime_type' => $mime_type, 'extension' => $original_ext]);
        }
        return array('success'=> true, 'response'=>'Product successfully created');
      }
    });
    
    return response()->json($response, 200);
  }


  public function updateProduct(Request $request){
     $product = Product::find($request->product_id);
    if($product){
      $product->feature = $request->feature;
      $product->benefits = $request->benefits;
      $product->updated_by = $request->updated_by;
      $product->timestamps = true;
      $product->save();
    }

    if($request->hasFile('image_choice')){
      $image = $request->image_choice;
      $original_name = $image->getClientOriginalName();
      if(ProductImage::whereNull('deleted_at')->where('original_name', '=', $original_name)->count() > 0){
        return response()->json(array('success'=> false, 'response'=> 'Product image already exist, you can check the product list.'), 200);
      }
    }
          
    //  $product = Product::find($request->product_id)->update($request->only(['feature', 'benefits', 'updated_by']));

     $productImgDirectoryName = str_replace(':', '', preg_replace('/[-,\s]/', '_', $product->created_at)) . '_' .  $product->id;
     $pImageId = $product->image->id;

        if($request->hasFile('image_choice')){
              $image = $request->image_choice;
              $original_name = $image->getClientOriginalName();
              $mime_type = $image->getMimeType();
              $original_ext = $image->getClientOriginalExtension();
              $path =  $image->store("$productImgDirectoryName", 'productimages');
              $productImage  = ProductImage::find($pImageId);
              // Storage::delete('../storage/product_images/', $productImage->path);
              $productImage->update(['path' => $path, 'original_name' => $original_name, 'mime_type' => $mime_type, 'extension' => $original_ext]);
 
        }
      return response()->json(array('success'=> true), 200);
    // return response()->json($request);
  }


  public function deleteProduct(Request $request){
    $response = array('success'=> false);
    $response = DB::transaction(function () use ($request) {
        Product::findOrFail($request->prodId)->delete();
        $productImage = ProductImage::where('product_id', $request->prodId);
        if(!$productImage->delete()){
           throw new \Exception('An error occurred during deletion of product image');
           return array('success'=> false);
        }
        return array('success'=> true);
     });
     
     return response()->json($response, 200);
  }



  public function checkUpdates(){
    // Alert::success('Success Message', 'Optional Title');
      $product = Product::all();
      foreach($product as $p){
        $query = "SELECT
        MSI.BARCODE as barcode,
        MSI.LEGACY_BARCODE as legacy_barcode,
        MSI.DESCRIPTION as description,
        MSI.BRANDNAME as brand,
        AP.VENDOR_NAME as supplier,
        MSI.DIVISIONNAME as division,
        MSI.DEPARTMENTNAME as department,
        MSI.CATEGORYNAME as category,
        MSI.SUBCATEGORYNAME as sub_category,
        MSI.INVENTORY_ITEM_STATUS_CODE as status,
        MSI.MATERIALNAME as material,
        MSI.DIMENSIONNAME as dimension,
        MSI.FINISHCOLORNAME as finish_color,
        MSI.MODELFRMSUPPLIERNAME as code,
        MSI.MSIB_LAST_UPDATE_DATE as ebs_msi_updated_at,
        MSI.CAT_UPDATE_DATE as ebs_ic_updated_at,
        MSIB_LAST_UPDATE_BY as ebs_msi_updated_by
        FROM 
        XXCH_PRODUCT_LISTING_V MSI,
        DWT_DIM_EX_SUPPLIER  AP 
        WHERE 
        AP.SEGMENT1 = MSI.VENDORCODE AND 
        MSI.BARCODE = '$p->barcode'";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
           if($result["ebs_msi_updated_at"] != $p->ebs_msi_updated_at || $result["ebs_ic_updated_at"] != $p->ebs_ic_updated_at){
              // return response()->json($result);
              $currProduct = Product::find($p->id);
              foreach($result as $r => $value){
                $currProduct->$r = $value;
              }
              $currProduct->timestamps = false;
              $currProduct->save();
              // $currProduct->barcode = $result["barcode"];
             return $currProduct;


           }
        }
      }
  }
}
