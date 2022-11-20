<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
