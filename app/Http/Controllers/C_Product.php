<?php

namespace App\Http\Controllers;

use App\Models\productCategory;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Image;

class C_Product extends Controller
{
    public $productCategory;
    public $user;
    public $product;

    public function __construct()
    {
        $this->productCategory = new productCategory();
        $this->user = new User();
        $this->product = new Product();
        if (session()->has('user')) {
        }else{
            return redirect()->route('login');
        }
    }

    //
    public function index()
    {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        $getProductCategory = $this->productCategory->getAllproductCategory();

        $getProduct = $this->product->getProductAll();
        if (session()->has('user')) {
            # code...

            return view('Dashboard.product',
                compact(
                'userData',
                'getProductCategory',
                'getProduct'
                )
            );
        }else{
            return redirect()->route('login');
        }
    }
    public function addProduct()
    {
        $getProductCategory = $this->productCategory->getAllproductCategory();
        // dd($getProductCategory)
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);

        if (session()->has('user')) {
            # code...
            return view('Dashboard.addProduct',
                compact(
                    'getProductCategory',
                    'userData'
                ));
        }else{
            return redirect()->route('login');
        }
    }

    public function addProductAction(Request $request)
    {
        if (empty($request->productCategory)) {
            redirect()->back()->with('error', 'Masukan kategori produk');
        }
        $request->validate([
            'productCategory' => 'required',
        ]);

        $imgProduct="";
        if (!empty($request->file('imgProduct'))) {
            $image = $request->file('imgProduct');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Upload original image
            $image->move(public_path('Uploads/product'), $imageName);

            // Compress and save a new version
            $compressedImage = Image::make(public_path('Uploads/product/'. $imageName))
                ->encode('jpg', 50); // Specify compression quality

            // Ensure that the destination directory exists
            $compressedDirectory = public_path('Uploads/productCompressed/');
            if (!file_exists($compressedDirectory)) {
                mkdir($compressedDirectory, 0755, true);
            }

            // Save the compressed image
            $compressedImage->save(public_path('Uploads/productCompressed/' . $imageName));

            $imgProduct =$imageName;
        }


        $insertProduct = $this->product->insertProduct([
            'id_productCategory'    => $request->productCategory,
            'nameProduct'           => $request->nameProduct,
            'descProduct'           => $request->descProduct,
            'imgProduct'            => $imgProduct,
            'stockProduct'          => $request->stock,
            'startPrice'            => $request->hargaAwal,
            'priceProduct'          => $request->harga,
            'statusProduct'         => $request->status
        ]);
        // dd($imgProduct);
        return redirect()->route('product')->with('success','Produk berhasil '.$request->product.' di simpan');
    }

    public function editProduct($id_product)  {


        $decryptedID = Crypt::decrypt($id_product);

        $getProduct = $this->product->firstProduct(['id_product'=>$decryptedID]);

        $getProductCategory = $this->productCategory->getAllproductCategory();
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);

        if (session()->has('user')) {
            # code...
            return view('Dashboard.editProduct',
                compact(
                    'getProduct',
                    'getProductCategory',
                    'userData'
                ));
        }else{
            return redirect()->route('login');
        }
    }
    public function editProductAction(Request $request, $id_product) {
        $decryptedID = Crypt::decrypt($id_product);

        $imgProduct="";
        if (!empty($request->file('imgProduct'))) {
            $image = $request->file('imgProduct');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Upload original image
            $image->move(public_path('Uploads/product'), $imageName);

            // Compress and save a new version
            $compressedImage = Image::make(public_path('Uploads/product/'. $imageName))
                ->encode('jpg', 50); // Specify compression quality

            // Ensure that the destination directory exists
            $compressedDirectory = public_path('Uploads/productCompressed/');
            if (!file_exists($compressedDirectory)) {
                mkdir($compressedDirectory, 0755, true);
            }

            // Save the compressed image
            $compressedImage->save(public_path('Uploads/productCompressed/' . $imageName));

            $imgProduct =$imageName;
        }
        DB::table('product')
        ->where('id_product', $decryptedID) // Assuming $productId is the ID of the product you want to update
        ->update([
            'id_productCategory'    => $request->productCategory,
            'nameProduct'           => $request->nameProduct,
            'descProduct'           => $request->descProduct,
            'imgProduct'            => $imgProduct,
            'stockProduct'          => $request->stock,
            'startPrice'            => $request->hargaAwal,
            'priceProduct'          => $request->harga,
            'statusProduct'         => $request->status,
        ]);

        return redirect()->route('product')->with('success','Data Produk '.$request->nameProduct.' berhasil di ubah');
    }

     public function deleteProduct($id_product) {

        $decryptedID = Crypt::decrypt($id_product);
        DB::table('product')
        ->where('id_product', $decryptedID) // Assuming $productId is the ID of the product you want to update
        ->update([

            'stockProduct'          => 0,
            'statusProduct'         => 'nonactive',

        ]);

        return redirect()->back()->with('success','Data Produk berhasil di hapus');
    }
}
