<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;
use PDO;
class ItemUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check item updates from Oracle EBS';
    
    protected $conn;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {   
        
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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
        TO_CHAR(MSIB_LAST_UPDATE_DATE, 'dd-MON-YY hh24:mi:ss') as ebs_msi_updated_at,
        TO_CHAR(MSI.CAT_UPDATE_DATE, 'dd-MON-YY hh24:mi:ss') as ebs_ic_updated_at,
        MSIB_LAST_UPDATE_BY as ebs_msi_updated_by
        FROM 
        -- XXCH_PRODUCT_LISTING_V MSI,
        XXCH_PRODUCT_LISTING_DEV_V MSI,
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
        sleep(3);
      }    
        $this->info('check:updates command successfully done!');
    }
}