<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $primaryKey = "id_orderDetail";
    protected $table = "orderDetail";
    function insertOrderDetail($data)
    {
        return OrderDetail::insert($data);
    }
    function getOrderDetail() {
        return OrderDetail::select('*')
        ->join('order','orderDetail.id_order','=','order.id_order')
        ->join('product','orderDetail.id_product','product.id_product')
        ->get();

    }
    function getOrderDetailWhereJoinOrderUser($where)  {
        return OrderDetail::select('*')
        ->join('order','orderDetail.id_order','=','order.id_order')
        ->join('product','orderDetail.id_product','product.id_product')
        ->join('user','order.id_user','=','user.id_user')
        ->where($where)
        ->get();

    }
}
