<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCategory extends Model
{
    use HasFactory;
    protected $primaryKey = "id_orderCategory";
    protected $table = "orderCategory";
    public function getOrderCategory($select){
        return OrderCategory::select($select)
        ->get();
    }
    public function firstOrderCategory($select,$where){
        return OrderCategory::select($select)
        ->where($where)
        ->first();
    }
    public function getWhereOrderCategory($select,$where) {
        return OrderCategory::select($select)
        ->where($where)
        ->get();
    }
    public function insertOrderCategory($data){
        return OrderCategory::insert($data);
    }
}
