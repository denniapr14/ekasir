<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class C_ProductCategory extends Controller
{
    public $productCategory;
    public $user;

    public function __construct()
    {
        $this->productCategory = new ProductCategory();
        $this->user = new User();
    }


    //
    public function index()
    {
        if (session()->has('user')) {
            # code...
            return view('Dashboard.product');
        }
    }
    public function addproductCategory()
    {
        $getproductCategory = $this->productCategory->getAllproductCategory();
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);

        if (session()->has('user')) {
            # code...
            return view(
                'Dashboard.addproductCategory',
                compact(
                    'getproductCategory',
                    'userData'
                )
            );
        }
    }

    public function addProductCategoryAction(Request $request)
    {

        if (empty($request->productCategory)) {
            redirect()->back()->with('error', 'Pilih rumah yang akan diterapkan promo');
        }
        $request->validate([
            'productCategory' => 'required',
        ]);
        $dataProductCategory = $this->productCategory->insertproductCategory(
            [
                'productCategory' => $request->productCategory,
                'statusCategory' => 'active',
            ]
        );
        // dd($dataProductCategory);
        return redirect()->back()->with('success', 'Kategory produk ' . $request->productCategory . ' berhasil disimpan!');
    }

    public function editProductCategoryAction(Request $request, $id_categoryProduct)
    {
        $decryptedID = Crypt::decrypt($id_categoryProduct);

        if (empty($request->editProductCategory)) {
            return redirect()->back()->withErrors(['error' => 'Pilih rumah yang akan diterapkan promo']);
        }

        $request->validate([
            'editProductCategory' => 'required',
        ]);

        DB::table('productCategory')
            ->where('id_productCategory', $decryptedID)
            ->update([
                'productCategory' => $request->editProductCategory,
                'statusCategory' => $request->editStatusProductCategory,
            ]);

        return redirect()->route('product')->with('success', 'Kategory produk ' . $request->editProductCategory . ' berhasil disimpan!');
    }
}
