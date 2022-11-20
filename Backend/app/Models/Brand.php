<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table='brand';
    protected $primaryKey='brand_id';

    public function products()
    {
        return $this->hasMany(Product::class,'product_id','product_id');
    }
}