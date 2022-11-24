<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
        return $this->belongsTo(SubCategory::class,'subcate_id','_id');
    }
    public static function getStatistical1()
    {
        return DB::select("SELECT product.subcate_id,SUM(orderdetail.quantity) AS id FROM product,orderdetail WHERE`product`.`product_id`=orderdetail.product_id GROUP BY product.subcate_id");
    }
    public static function getStatistical2($month)
    {
        return DB::select("SELECT SUM(`order`.`total`) AS tt FROM `order` WHERE `order`.created_at BETWEEN '2022-0".$month."-01' AND '2022-0".$month."-31'");
    }
}
