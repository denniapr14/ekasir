<?php

namespace App\Http\Controllers;

use App\Models\OrderCategory;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Image;

class C_OrderCategory extends Controller
{
    public $orderCategory;
    public $user;
    //
    public function __construct()
    {
        $this->orderCategory = new OrderCategory;
        $this->user = new User;
    }
    public function index()
    {
        $getOrderCategory = $this->orderCategory->getOrderCategory('*');
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        if (session()->has('user')) {
            # code...

            return view(
                'Dashboard.orderCategory',
                compact(
                    'userData',
                    'getOrderCategory'
                )
            );
        } else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function addOrderCategoryAction(Request $request)
    {
        if (session()->has('user')) {

            if (empty($request->orderCategory)) {
                redirect()->back()->with('error', 'Pilih rumah yang akan diterapkan promo');
            }
            $request->validate([
                'orderCategory' => 'required',
            ]);
            $imgOrderCategory="";
            if (!empty($request->file('imgOrderCategory'))) {
                $image = $request->file('imgOrderCategory');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Upload original image
                $image->move(public_path('Uploads/orderCategory/'), $imageName);

                // Compress and save a new version
                $compressedImage = Image::make(public_path('Uploads/orderCategory/'. $imageName))
                    ->encode('jpg', 50); // Specify compression quality

                // Ensure that the destination directory exists
                $compressedDirectory = public_path('Uploads/orderCategoryCompressed/');
                if (!file_exists($compressedDirectory)) {
                    mkdir($compressedDirectory, 0755, true);
                }

                // Save the compressed image
                $compressedImage->save(public_path('Uploads/orderCategoryCompressed/' . $imageName));

                $imgOrderCategory =$imageName;
            }

            $dataProductCategory = $this->orderCategory->insertOrderCategory(
                [
                    'orderCategory' => $request->orderCategory,
                    'markUp'        => $imgOrderCategory,
                    'statusOrderCategory' => 'active',
                ]
            );

            return redirect()->route('orderCategory')->with('success','Order Kategory '.$request->orderCategory.' berhasil di simpan');
        } else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
    public function editOrderCategoryAction(Request $request, $id_OrderCategory)
    {
        $decryptedID = Crypt::decrypt($id_OrderCategory);

        if (session()->has('user')) {

            if (empty($request->editOrderCategory)) {
                redirect()->back()->with('error', 'Pilih rumah yang akan diterapkan promo');
            }
            $request->validate([
                'editOrderCategory' => 'required',
            ]);
            $imgOrderCategory="";
            if (!empty($request->file('editImgOrderCategory'))) {
                $image = $request->file('editImgOrderCategory');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Upload original image
                $image->move(public_path('Uploads/orderCategory/'), $imageName);

                // Compress and save a new version
                $compressedImage = Image::make(public_path('Uploads/orderCategory/'. $imageName))
                    ->encode('jpg', 50); // Specify compression quality

                // Ensure that the destination directory exists
                $compressedDirectory = public_path('Uploads/orderCategoryCompressed/');
                if (!file_exists($compressedDirectory)) {
                    mkdir($compressedDirectory, 0755, true);
                }

                // Save the compressed image
                $compressedImage->save(public_path('Uploads/orderCategoryCompressed/' . $imageName));

                $imgOrderCategory = $imageName;
            }



            DB::table('orderCategory')
            ->where('id_orderCategory', $decryptedID) // Assuming $productId is the ID of the product you want to update
            ->update([
                'orderCategory' => $request->editOrderCategory,
                'markUp'        => $imgOrderCategory,
                'statusOrderCategory' => $request->editStatusOrderCategory,
            ]);

            return redirect()->route('orderCategory')->with('success','Order Kategory '.$request->orderCategory.' berhasil di simpan');
        } else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
    public function changeStatusOrderCategory($id_orderCategory)
    {
    }
}
