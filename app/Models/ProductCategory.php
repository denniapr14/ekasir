<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $primaryKey = "id_productCategory";
    protected $table = "productcategory";


    function firstProductCategory($where) {
        return ProductCategory::select('*')
        ->where($where)
        ->first();
    }
    public function getAllproductCategory(){
        return ProductCategory::select('*')
        ->get();
    }
    public function insertproductCategory($data) {
        return ProductCategory::insert($data);

    }

}
