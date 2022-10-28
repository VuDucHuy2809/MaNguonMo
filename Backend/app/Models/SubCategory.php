<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class SubCategory extends Model
{
    use HasFactory;
    protected $table='subcategory_product';
    protected $primaryKey='subcate_id';
    protected $fillable=[
        'name'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'cate_id','subcate_id');
    }
}
