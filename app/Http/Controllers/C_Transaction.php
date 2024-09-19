<?php

namespace App\Http\Controllers;

use App\Models\OrderCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use Midtrans\Config;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;


class C_Transaction extends Controller
{
    public $product;
    public $user;
    public $cart;
    public $orderCategory;

    public function __construct()
    {
        $this->product = new Product();
        $this->user = new User();
        $this->cart = new Cart();
        $this->orderCategory = new OrderCategory();
    }

    public function index()
    {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        $getCart = $this->cart->getCartJoinProduct([
            'id_user'    => $userData->id_user,
            'statusCart' => 'cart'
        ]);
        $getOrderCategory = $this->orderCategory->getOrderCategory('*');
        $getProduct = $this->product->getProductWherePaggination([
            'statusProduct' => 'active'
        ], 21);

        // dd($getProduct);
        if (session()->has('user')) {
            # code...

            return view(
                'Dashboard.transaction',
                compact(
                    'userData',
                    'getProduct',
                    'getCart',
                    'getOrderCategory'
                )
            );
        } else {
            return redirect()->route('login');
        }
    }
    function addTransaction($id, $status, $qty, $price, $startPrice)
    {
        $getProduct = $this->product->getProductWherePaggination([
            'statusProduct' => 'active'
        ], 21);
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        $decryptedID = Crypt::decrypt($id);
        $decryptedStatus = Crypt::decrypt($status);
        $decryptedQuanty = Crypt::decrypt($qty);
        $decryptedPrice = Crypt::decrypt($price);
        $decryptedStartPrice =  Crypt::decrypt($startPrice);
        if (session()->has('user')) {
            $getCart = $this->cart->firstCart(
                [
                    'id_product' => $decryptedID,
                    'id_user'    => $userData->id_user,
                    'statusCart' => 'cart'
                ]
            );
            if ($decryptedStatus == "Plus") {
                if ($getCart == null) {
                    // Insert a new cart item
                    $dataInput = [
                        'id_product' => $decryptedID,
                        'id_user'    => $userData->id_user,
                        'statusCart' => "cart",
                        'startPriceCart' => $decryptedStartPrice,
                        'quantyCart' => $decryptedQuanty,
                        'priceCart'  => $decryptedPrice,
                    ];
                    $this->cart->insertCart($dataInput);
                } else {
                    // Update existing cart item
                    $newQuanty = $getCart->quantyCart + $decryptedQuanty;
                    $newPrice = $getCart->priceCart + $decryptedPrice;
                    $newStartPrice = $getCart->startPriceCart + $decryptedStartPrice;

                    // Check if the product stock is greater than 1 before updating the cart
                    $productStock = DB::table('product')
                        ->where('id_product', $decryptedID)
                        ->value('stockProduct');

                    if ($productStock > 1) {
                        // Update the cart only if the product stock is greater than 1
                        DB::table('cart')
                            ->where([
                                'id_product' => $decryptedID,
                                'id_user'    => $userData->id_user,
                                'statusCart' => 'cart',
                            ])
                            ->update([
                                'quantyCart' => $newQuanty,
                                'priceCart'  => $newPrice,
                                'startPriceCart' => $newStartPrice
                            ]);
                    } else {
                        return redirect()->route('transaction')->with('success', 'produk hanya tinggal 1');
                    }
                }
            }
            if ($decryptedStatus == "Minus") {
                if ($getCart == null) {
                    return redirect()->route('transaction')->with('success', 'product sudah tidak ada di keranjang');
                } else {

                    DB::table('cart')
                        ->where([
                            'id_product' => $decryptedID,
                            'id_user'    => $userData->id_user,
                            'statusCart' => 'cart'
                        ]) // Assuming $productId is the ID of the product you want to update
                        ->update([
                            'startPriceCart' => $getCart->startPriceCart - $decryptedStartPrice,
                            'quantyCart'          => $getCart->quantyCart - $decryptedQuanty,
                            'priceCart'     => $getCart->priceCart - $decryptedPrice,
                        ]);
                }
            }
            return redirect()->route('transaction')->with('success', 'product sudah ditambahkan di keranjang');
        } else {
            return redirect()->route('login');
        }
    }

    function costumTransactionAction(Request $request, $id)
    {

        $decryptedID = Crypt::decrypt($id);
        $firstProduct = $this->product->firstProduct(['id_product'  => $decryptedID]);
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        $getCart = $this->cart->firstCart(
            [
                'id_product' => $decryptedID,
                'id_user'    => $userData->id_user,
                'statusCart' => 'cart'
            ]
        );


        if (session()->has('user')) {

            $dataCostum = null;

            if ($getCart == null) {
                $dataCostum = [
                    'id_product'    => $decryptedID,
                    'id_user'       => $userData->id_user,
                    'statusCart'    => "cart",
                    'startPriceCart' => $firstProduct->priceProduct  * $request->countProduct,
                    'quantyCart'    => $request->countProduct,
                    'priceCart'     => $firstProduct->priceProduct * $request->countProduct,
                ];
                $this->cart->insertCart($dataCostum);
            } else {

                DB::table('cart')
                    ->where([
                        'id_product' => $decryptedID,
                        'id_user'    => $userData->id_user,
                        'statusCart' => 'cart'
                    ]) // Assuming $productId is the ID of the product you want to update
                    ->update([
                        'startPriceCart' => $getCart->startPriceCart + ($firstProduct->priceProduct * $request->countProduct),
                        'quantyCart'          => $getCart->quantyCart + $request->countProduct,
                        'priceCart'     => $getCart->priceCart + ($firstProduct->priceProduct * $request->countProduct),
                    ]);
            }

            # code...
            return redirect()->route('transaction')->with('success', 'product sudah ditambahkan di keranjang');
        } else {
            return redirect()->route('login');
        }
    }


    public function updateCartQuantity($id, $action)
    {
        $cart = $this->cart->firstCart(['id_cart' => $id]);
        $firstProduct = $this->product->firstProduct(['id_product'  => $cart->id_product]);

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Cart not found']);
        }

        // Increment or decrement quantity based on the action
        if ($action == 'increment') {

            if ($cart->quantyCart + 1 > $firstProduct->stockProduct) {
                return response()->json(['success' => false, 'message' => 'Quantity exceeds available stock']);
            }

            DB::table('cart')
                ->where(['id_cart' => $id])
                ->update([
                    'startPriceCart' => $cart->startPriceCart + ($firstProduct->startPrice * 1),
                    'quantyCart' => $cart->quantyCart + 1,
                    'priceCart' => $cart->priceCart + ($firstProduct->priceProduct * 1),
                ]);
        } elseif ($action == 'decrement' && $cart->quantyCart > 1) {
            DB::table('cart')
                ->where(['id_cart' => $id])
                ->update([
                    'startPriceCart' => $cart->startPriceCart - ($firstProduct->startPrice * 1),
                    'quantyCart' => $cart->quantyCart - 1,
                    'priceCart' => $cart->priceCart - ($firstProduct->priceProduct * 1),
                ]);
        } elseif($action == 'decrement' && $cart->quantyCart == 1)
        {
            DB::table('cart')
            ->where(['id_cart' => $id])
            ->update([
                'startPriceCart' => $cart->startPriceCart - ($firstProduct->startPrice * 1),
                'quantyCart' => $cart->quantyCart - 1,
                'priceCart' => $cart->priceCart - ($firstProduct->priceProduct * 1),
                'statusCart' => 'deleted'
            ]);
        }

        // Fetch the updated cart after the update
        $updatedCart = $this->cart->firstCart(['id_cart' => $id]);

        return response()->json([
            'success'       => true,
            'quantity'      => $updatedCart->quantyCart,
            'totalPrice'    => rupiah($firstProduct->priceProduct * $updatedCart->quantyCart),
            'price'         => $firstProduct->priceProduct,
            'productStock'  => $firstProduct->stockProduct,
        ]);
    }




    public function pay($total)
    {
        // Set Midtrans credentials
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = !config('services.midtrans.is_sandbox');

        // Create an order and get the order ID
        $orderId = rand(10);

        // Other order details and items...

        // Generate payment URL
        $paymentUrl = $this->generatePaymentUrl($orderId);

        // Redirect the user to the payment URL
        return $paymentUrl;
    }

    // MIDTRANS

}
