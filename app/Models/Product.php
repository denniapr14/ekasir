<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = "id_product";
    protected $table = "product";

    public function getProductAll() {
        return Product::select('*')
        ->get();
    }
    public function getProductWhere($where) {
        return Product::select('*')
        ->where($where)
        ->get();

    }

    public function getProductWherePaggination($where,$pagination){
        return Product::select('*')
        ->where($where)
        ->paginate($pagination);

    }

    public function firstProduct($where){
        return Product::where($where)
        ->first();
    }
    public function insertProduct($data) {
        return Product::insert($data);
    }
}
