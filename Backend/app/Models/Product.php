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
    protected $fillabel = [
        'name',
        'quantity',
        'price',
        'image',
        'description',
        'status'
    ];

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class,'product_id');
    }
    public function productAttributes()
    {
        return $this->belongsToMany(ProductAttribute::class,'attribute_values','product_id','product_attribute_id');
    }
}
