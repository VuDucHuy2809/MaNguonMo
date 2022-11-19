<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discount';
    protected $primaryKey='discount_id';
    public function products()
    {
        return $this->hasMany(Product::class,'product_id','product_id');
    }
}
