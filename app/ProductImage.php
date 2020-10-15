<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{   
    use SoftDeletes;
    protected $fillable = [
        'path',
        'original_name',
        'product_id',
        'extension',
        'mime_type'
    ];

    public function product(){
        return $this->belongsTo('App\Product', 'product_id');
    }
}
