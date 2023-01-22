<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    //
    protected $fillable=['id','variation_value','status'];
    protected $casts = [ 'id' => 'string'];
    protected $table='variant';
}
