<?php

namespace App;
use App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Variantdetails extends Model
{
    //
    protected $fillable=['id','product_id','variant_id','variant_value','variant_sku'];
    protected $casts = [ 'id' => 'string'];
    protected $table='variant_manage';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
