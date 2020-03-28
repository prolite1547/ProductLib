<?php

namespace App\Http\Controllers;
use PDO;
use App\Http\Resources\BrandResources as BrandResource;
use App\Product;
use Illuminate\Http\Request;


class ReportController extends Controller
{
        protected $conn;
        public function __construct()
        {
                $options = [
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_CASE => PDO::CASE_LOWER,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM,
                    ];
                /*Oracle*/
                $myServer = '192.168.3.115';
                $myDB = 'DW';
                $oci_uname = 'dw';
                $oci_pass = 'dw';
                $tns = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$myServer.")(PORT = 1521)))(CONNECT_DATA=(SID=".$myDB.")))";
                try {
                    $this->conn = new PDO("oci:dbname=".$tns. ';charset=UTF8', $oci_uname, $oci_pass,$options);
                } catch(PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
                }
            
        }


        public function getBrand(){
            $result = Product::distinct('brand')->get(['brand']);
            return response()->json($result, 200);
            // $query = "SELECT DISTINCT(BRANDNAME) as BRAND  FROM XXCH_PRODUCT_LISTING_V ORDER BY BRANDNAME ASC";
            // $stmt = $this->conn->prepare($query);
            // if($stmt->execute()){
            //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //     return response()->json($result, 200);
            // }

        }

        public function getDimension(){
            $result = Product::distinct('dimension')->get('dimension');
            return response()->json($result, 200);
            // $query = "SELECT DISTINCT(DIMENSIONNAME) as DIMENSION FROM XXCH_PRODUCT_LISTING_V ORDER BY DIMENSIONNAME ASC";
            // $stmt = $this->conn->prepare($query);
            // if($stmt->execute()){
            //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //     return response()->json($result, 200);
            // }
        }


        public function generateReport(Request $request){


            $products = Product::where('status', '=', $request->status)->when($request->barcode, function($products) use ($request){
                    return $products->where('barcode', '=', $request->barcode);
            })->when($request->description, function($products) use ($request){
                    return $products->where('description', 'like', "%{$request->description}%");
            })->when($request->dimension , function($products) use ($request){
                    return $products->whereIn('dimension', $request->dimension);
            })->when($request->brand, function($products) use ($request){
                    return $products->whereIn('brand', $request->brand);
            })->get();
             
            //  $products = Product::where('barcode', '=', $request->barcode)
            //  ->get();
            // align-content-start 
 
             $markup = "<div class='d-flex align-content-start flex-wrap'>";
             $markupData = "";
             foreach($products as $p){
                
                 $path = "../images/no-image.png";
                if($p->image != null){
                    $path = "../storage/product_images/".$p->image->path;
                }

                $features = self::buildList($p->feature);
                $benefits = self::buildList($p->benefits);
                $card_body = "";

                if(in_array('All', $request->printing_details)){
                    $card_body = "<label class='card-text'><b>".$p->description."</b></label><br>
                    <label class='card-text'>".$p->barcode."</label><br>
                    <label class='card-text'><b>Brand : </b>".$p->brand."</label><br>
                    <label class='card-text'><b>Size : </b>".$p->dimension."</label><br>
                    <label class='card-text'><b>Code : </b>".$p->code."</label><br>
                    <label class='card-text'><b>Feature : </b>".$features."</label><br>
                    <label class='card-text'><b>Benefits : </b>".$benefits."</label>";
                }else{
                    $card_body .= self::printDetails('Description', $request->printing_details , $p->description);
                    $card_body .= self::printDetails('Barcode', $request->printing_details , $p->barcode);
                    $card_body .= self::printDetails('Brand', $request->printing_details , $p->brand);
                    $card_body .= self::printDetails('Dimensions', $request->printing_details , $p->dimension);
                    $card_body .= self::printDetails('Code', $request->printing_details , $p->code);
                    $card_body .= self::printDetails('Feature', $request->printing_details , $features);
                    $card_body .= self::printDetails('Benefits', $request->printing_details , $benefits);
                }
               
                // p-2 flex-wrap
                $markupData .= "<div class='p-2 flex-wrap'>
                                    <div class='card px-2 report_items' style='width: 15rem; height: 100%; '>
                                        <img src='".$path."' class='card-img-top' alt='...'>
                                        <div class='card-body'>
                                        ".$card_body."
                                        </div>
                                    </div>
                               </div>";
             }
            
             $markup .= $markupData . "</div>";
             return $markup;
        }

          function buildList($list){
            $ul = "";
            $li = "";
            if($list){
                $features = explode("\n", $list);
                foreach($features as $f){
                    $li .= "<li>".$f."</li>";
                }
                $ul .= "<ul>". $li ."</ul>";
            }
            return $ul;
        }

          function printDetails($string, $array, $value){
                if($string == "Barcode"){
                    return "<label class='card-text'>".$value."</label><br>";
                }

                if(in_array($string, $array)){
                    if($string == "Dimensions"){
                        $string = "Size";
                    }
                    if($string == "Description"){
                        return "<label class='card-text'><b>".$value."</b></label><br>";
                    }else{
                        return "<label class='card-text'><b>".$string."</b> : ".$value."</label><br>";
                    }
                }
                return "";
        }
}
