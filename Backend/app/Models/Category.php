<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $table='category_product';
    protected $primaryKey='cate_id';
    protected $fillable=[
        'name',
        'status'
    ];
    public function subcategory()
    {
        return $this->HasMany(SubCategory::class,'cate_id','cate_id');
    }
    public static function getAllCate()
    {
        return DB::select('SELECT * FROM `category_product`,`subcategory_product` WHERE category_product.cate_id=subcategory_product.subcate_id ');
    }
}   
