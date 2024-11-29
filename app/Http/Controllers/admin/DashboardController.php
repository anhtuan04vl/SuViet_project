<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\ProductModel;
use App\Models\Order;
use Illuminate\Http\Request;
use DB;


class DashboardController extends Controller
{
    public function showthongke()
    {
        // Tổng số đơn hàng
        $totalOrders = DB::table('orders')->count();

        // Tổng doanh thu
        $totalRevenue = DB::table('orders')->sum('total');

        // Đơn hàng theo trạng thái
        $ordersByStatus = DB::table('orders')
            ->select('order_status_id', DB::raw('COUNT(*) as total'))
            ->groupBy('order_status_id')
            ->get();

        // Doanh thu theo ngày
        $revenueByDate = DB::table('orders')
            ->select(DB::raw('DATE(order_date) as date'), DB::raw('SUM(total) as revenue'))
            ->groupBy(DB::raw('DATE(order_date)'))
            ->get();

        // Doanh thu theo tuần
        $revenueByWeek = DB::table('orders')
        ->select(DB::raw('YEAR(order_date) as year, WEEK(order_date) as week, SUM(total) as revenue'))
        ->groupBy(DB::raw('YEAR(order_date), WEEK(order_date)'))
        ->orderBy('year', 'desc')
        ->orderBy('week', 'desc')
        // ->take(5) // Lấy 5 tuần gần nhất
        ->get();    

        return view('admin.template.dashboard', [
        'totalOrders' => $totalOrders,
        'totalRevenue' => $totalRevenue,
        'ordersByStatus' => $ordersByStatus,
        'revenueByDate' => $revenueByDate,
        'revenueByWeek' => $revenueByWeek
        ]);
    }

    public function newProducts()
    {
        // Lấy 12 sản phẩm mới nhất
        $newProducts = ProductModel::latest()->take(12)->get();
    
        // Lấy 5 đơn hàng gần nhất
        $recentOrders = Order::latest()->take(5)->get();
    
        return view('admin.template.dashboard', [
            'newProducts' => $newProducts,
            'recentOrders' => $recentOrders,
        ]);
    }


    public function showtest()
    {
        return view('admin.template.test');
    }
}
