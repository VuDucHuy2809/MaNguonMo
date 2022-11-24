<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table='order';
    protected $primaryKey = 'order_id';
    use HasFactory;
    public function accounts()
    {
        return $this->belongsTo(Account::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }
    public static function getDetailOrder($id)
    {
        return DB::select('SELECT `accounts`.`user_id`,`order`.`order_id`,`product`.`name`,orderdetail.price,orderdetail.quantity,product.image FROM `orderdetail`,`order`,`product`,`accounts` WHERE orderdetail.order_id=`order`.order_id and orderdetail.product_id=product.product_id and `order`.user_id=accounts.user_id and `order`.order_id='.$id);
    }
}
