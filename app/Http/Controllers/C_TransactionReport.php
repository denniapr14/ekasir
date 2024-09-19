<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\OrderCategory;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class C_TransactionReport extends Controller
{
    //
    public $user;
    public $order;
    public $orderDetail;

    function __construct(){
        $this->user = new User();
        $this->order = new Order();
        $this->orderDetail =  new OrderDetail();
    }

    function getReportOrder() {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);

        if (session()->has('user')) {

            if ($userData->levelUser == "admin") {
                $getOrder = $this->order->getOrderJoinOrderCategory()->sortByDesc('dateInputOrders')->collect();
                $getOrderDetail = $this->orderDetail->getOrderDetail();
            }else if($userData->levelUser == "kasir"){
                $getOrder=$this->order->getOrderWhereJoinUser(['user.id_user' => $userData->id_user])->sortByDesc('dateInputOrders')->collect();
                $getOrderDetail = $this->orderDetail->getOrderDetailWhereJoinOrderUser(['user.id_user' => $userData->id_user]);
            }
            else{
                $getOrderDetail="";
                $getOrder = "";
            }
            // dd($getOrderDetail);
            # code...
            return view('Dashboard.reportOrder',
                compact(
                    'userData',
                    'getOrder',
                    'getOrderDetail',
                )
            );
        } else {
            return redirect()->route('login');
        }

    }
}
