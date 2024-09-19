<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = "id_order";
    protected $table = "order";
    function insertOrder($data)
    {
        return Order::insert($data);
    }
    function getInsertIDOrder($data) {
        return Order::insertGetId($data);

    }
    function firstOrder($where)  {
        return Order::select('*')
        ->where($where)
        ->first();

    }

    function getOrder() {
        return Order::select('*')
        ->get();
    }
    function getOrderJoinOrderCategory() {
        return Order::select('*')
        ->join("orderCategory","order.id_orderCategory",'orderCategory.id_orderCategory')
        ->get();
    }
    function firstOrderJoinOrderCategoryWhere($where) {
        return Order::select('*')
        ->join("orderCategory","order.id_orderCategory",'orderCategory.id_orderCategory')
        ->where($where)
        ->first();
    }
    function getOrderWhereJoinUser($where) {
        return Order::select('*')
        ->join("orderCategory","order.id_orderCategory",'orderCategory.id_orderCategory')
        ->join('user','order.id_user','user.id_user')
        ->where($where)
        ->get();

    }
}
