<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{     
   
   use SoftDeletes;
   //   public $timestamps  = false ;
     protected $fillable = [
        'barcode',
        'legacy_barcode',
        'description',
        'supplier',
        'brand',
        'division',
        'department',
        'category',
        'sub_category',
        'status',
        'material',
        'code',
        'dimension',
        'finish_color',
        'feature',
        'benefits',
        'last_update_date',
        'last_update_by',
      //   'ebs_msi_updated_at',
      //   'ebs_msi_updated_by',
        'user_id',
        'updated_by',
      //   'ebs_ic_updated_at',
        'updated_at',
        'created_at'
     ];

     public function image(){
        return $this->hasOne('App\ProductImage');
     }
}
