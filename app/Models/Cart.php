<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey = "id_cart";
    protected $table = "cart";

    function getCart($where) {
        return Cart::select('*')
        ->where($where)
        ->get();
    }
    function getCartJoinProduct($where) {
        return Cart::select('*')
        ->join('product','cart.id_product','product.id_product')
        ->where($where)
        ->get();

    }
    function firstCart($where) {
        return Cart::select('*')
        ->where($where)
        ->first();
    }
    function delCartWhere($where) {
        return Cart::where($where)->delete();

    }

    function insertCart($data) {
        return Cart::insert($data);
    }

}