<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\OrderCategory;
use App\Models\Order;
use App\Models\OrderDetail;

use Midtrans\Snap;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class C_Checkout extends Controller
{
    public $product;
    public $user;
    public $cart;
    public $orderCategory;
    public $order;
    public $orderDetail;
    // public $snapToken;


    public function __construct()
    {
        $this->order = new Order();
        $this->product = new Product();
        $this->user = new User();
        $this->cart = new Cart();
        $this->orderCategory = new OrderCategory();
        $this->orderDetail = new OrderDetail();
    }

    public function checkoutAction(Request $request, $id_user)
    {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        $getCart = $this->cart->getCartJoinProduct([
            'id_user'    => $userData->id_user,
            'statusCart' => 'cart'
        ]);


        $getOrderCategory = $this->orderCategory->getOrderCategory('*');

        // dd(generateRandomString(10));

        $request->validate([
            'selectedOrderCategory' => 'required',

        ]);
        // dd($request->selectedOrderCategory);
        if (session()->has('user')) {
            # code...
            $dataOrder = [
                'id_user' => $userData->id_user,
                'id_orderCategory' => $request->selectedOrderCategory,
                'priceOrder' => 0, // Initialize the price to 0
                'orderCode' => null,
            ];


            $dataOrderDetail = [];
            $total = 0;



            $idOrder =  $this->order->getInsertIDOrder($dataOrder);


            foreach ($getCart as $cart) {
                $dataOrder['priceOrder'] += $cart->priceCart;


                $total += $cart->priceCart;

                $getProduct = $this->product->firstProduct([
                    'id_product' => $cart->id_product
                ]);
                $dataOrderDetail[] = [
                    'id_product' => $cart->id_product,
                    // 'id_user'   => $userData->id_user,

                    'id_order'      => $idOrder,
                    'quantyOrderDetail' => $cart->quantyCart,
                    'startOrderDetail'  => $cart->quantyCart * $getProduct->startPrice,
                    'totalOrderDetail' => $cart->priceCart,
                ];

                DB::table('product')
                    ->where([
                        'id_product'    => $cart->id_product,
                        'statusProduct' => "active"

                    ]) // Assuming $productId is the ID of the product you want to update
                    ->update([
                        'stockProduct' => $getProduct->stockProduct - $cart->quantyCart,
                    ]);
                if ($getProduct->stockProduct - $cart->quantyCart == 0) {
                    DB::table('product')
                        ->where('id_product', $cart->id_product)
                        ->update([
                            'statusProduct' => 'nonactive',
                        ]);
                }
            }
            $orderCode =null;
            if ($request->selectedOrderCategory == 3) {
                $orderCode = $this->getMidtransCode($total);
                // dd($dataOrder);
                # code...
            }



            DB::table('order')
                ->where([
                    'id_order'    => $idOrder,

                ]) // Assuming $productId is the ID of the product you want to update
                ->update([
                    'priceOrder' => $total,
                    'orderCode'  => $orderCode,
                ]);

            // dd($dataOrder);

            DB::table('cart')
                ->where([
                    'id_user'    => $userData->id_user,
                    'statusCart' => 'cart'
                ]) // Assuming $productId is the ID of the product you want to update
                ->update([
                    'statusCart' => 'checkout'
                ]);
            $this->orderDetail->insertOrderDetail($dataOrderDetail);
            // dd($dataOrder);
            // if ($request->selectedOrderCategory == 3) {

            //     # code...
            //     return redirect()->route('checkoutMidtrans',$idOrder)->with('success', 'Terimakasih!');
            // }else{
            //     return redirect()->route('transaction')->with('success', 'Terimakasih!');

            // }
            return redirect()->route('checkoutMidtrans', $idOrder)->with('success', 'Terimakasih!');
        } else {
            return redirect()->route('login');
        }
    }

    function CheckoutMidtrans($orderID)
    {
        $getOrder = $this->order->firstOrderJoinOrderCategoryWhere(['id_order' => $orderID]);
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);

        $getOrderDetail = $this->orderDetail->getOrderDetailWhereJoinOrderUser(['orderDetail.id_order' => $orderID]);
        // dd($getOrderDetail);
        if (session()->has('user')) {
            # code...
            return view(
                'Dashboard.checkoutMidtrans',
                compact(
                    'userData',
                    'getOrder',
                    'getOrderDetail'
                )
            );
        } else {
            return redirect()->route('login');
        }
    }





    // public static function getSnapToken($amount)
    // {
    //     // Set your Midtrans credentials and configuration
    //     Config::$serverKey = 'SB-Mid-server-FyKYa5q8t8L57gs70uOXI9r7';
    //     Config::$isProduction = false;
    //     Config::$isSanitized = true;
    //     Config::$is3ds = true;
    //     $orderId = uniqid(mt_rand(), true); // Generates a unique ID based on the current timestamp and a random number

    //     // Extract only the numerical part of the generated ID and limit it to 10 digits
    //     $orderId = substr(preg_replace("/[^0-9]/", "", $orderId), 0, 10);
    //     // Create transaction parameters
    //     $params = [
    //         'transaction_details' => [
    //             'order_id' =>   $orderId,
    //             'gross_amount' => $amount,
    //         ],
    //         'customer_details' => [
    //             'name' => 'Deni',

    //             'email' => 'denniapr14@gmail.com',

    //         ],
    //     ];

    //     // Get Snap token
    //     $snapToken = Snap::getSnapToken($params);

    //     return $snapToken;
    // }

    function payment($idorder)
    {
        // dd($getOrderDetail);

        $decryptedID = Crypt::decrypt($idorder);

        $getOrder = $this->order->firstOrderJoinOrderCategoryWhere(['id_order' => $decryptedID]);
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);

        $getOrderDetail = $this->orderDetail->getOrderDetailWhereJoinOrderUser(['orderDetail.id_order' => $decryptedID]);
        if (session()->has('user')) {
            # code...

            DB::table('order')
                ->where([
                    'id_order' => $decryptedID
                ]) // Assuming $productId is the ID of the product you want to update
                ->update([
                    'statusOrder' => 'payed'
                ]);
            return redirect()->route('transaction')->with('success', 'Transaksi berhasil!');
        } else {
            return redirect()->route('login');
        }
    }
    function getMidtransCode($total)
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-FyKYa5q8t8L57gs70uOXI9r7';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // dd($total);
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return $snapToken;
    }

    //
}
