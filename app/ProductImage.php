<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
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
