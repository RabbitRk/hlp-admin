<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variantdetails extends Model
{
    //
    protected $fillable=['id','product_id','variant_id','variant_value','variant_sku'];
    protected $casts = [ 'id' => 'string'];
    protected $table='variant_manage';
}
