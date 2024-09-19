<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class C_Dashboard extends Controller
{
    //
    public $user;
    public function __construct()
    {
        $this->user = new User();
    }

    function index()
    {
        $totalSalesDataDaily = DB::table('order')
            ->select(
                DB::raw("DATE(dateInputOrders) AS date"),
                DB::raw("COUNT(*) AS total_orders"),
                DB::raw("SUM(priceOrder) AS total_sales")
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        $totalSalesData = DB::table('order')
            ->select(DB::raw("DATE_FORMAT(dateInputOrders, '%M') AS month"), DB::raw("SUM(priceOrder) AS total_sales"), DB::raw('YEAR(dateInputOrders) year'))
            ->groupBy('month', 'year')
            ->orderBy('dateInputOrders', 'asc')
            ->get();
        // dd($totalSalesData);
        // Fetch order status distribution data
        $orderStatusData = DB::table('order')
            ->select('statusOrder', DB::raw('COUNT(*) as count'))
            ->groupBy('statusOrder')
            ->get();

        // Fetch top selling products data
        $topProductsData = DB::table('orderDetail')
            ->join('product', 'orderDetail.id_product', '=', 'product.id_product')
            ->select('product.nameProduct', DB::raw('SUM(quantyOrderDetail) as total_quantity'))
            ->groupBy('product.nameProduct')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();
            // dd($topProductsData);

        if (session()->has('user')) {
            $userData = $this->user->firstUser(['id_user' => Session::get('user')]);

            return view(
                'Dashboard.index',
                compact(
                    'userData',
                    'totalSalesData',
                    'orderStatusData',
                    'topProductsData',
                    'totalSalesDataDaily'

                )
            );
        }
        return redirect(route('login'));
    }
}
