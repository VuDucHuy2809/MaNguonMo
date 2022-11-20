<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'product';
    protected $primaryKey='product_id';
    // protected $fillabel = [
    //     'name',
    //     'quantity',
    //     'price',
    //     'image',
    //     'description',
    //     'status'
    // ];
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','brand_id');
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class,'discount_id','discount_id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class,'size_id','size_id');
    }
    public function subCate()
    {
        return $this->belongsTo(SubCategory::class,'subcate_id','subcate_id');
    }
}
