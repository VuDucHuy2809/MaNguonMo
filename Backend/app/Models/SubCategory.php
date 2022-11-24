<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table='subcategory_product';
    protected $primaryKey='_id';
    protected $fillable=[
        'name'
    ];
    // public function products()
    // {
    //     return $this->hasMany(Product::class,'product_id','product_id');
    // }
}
