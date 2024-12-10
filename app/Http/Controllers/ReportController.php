<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Brand;;

use function Laravel\Prompts\alert;

class ReportController extends Controller
{

    public function index_report()
    {
        $years = Order::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        return view('report.index_report', compact('years'));
        return view('report.index_report');
    }


    public function getMonthlyData($year)
    {
        // Query invoice, filter by year, join with order, product and brands, group by month and brand
        try {
            $data = Invoice::select(
                DB::raw('DATE_FORMAT(invoices.paymentDate, "%Y-%m") as month'),
                'products.brand_id',
                DB::raw('COUNT(orders.id) as order_count'),
                DB::raw('SUM(invoices.amount) as total_profit')
            )
            ->join('orders', 'invoices.order_id', '=', 'orders.id')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->whereYear('invoices.paymentDate', $year)
            ->groupBy('month', 'products.brand_id')
            ->orderBy('month', 'asc')
            ->get();

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }

        // Prepare data structure for Chart.js
        $brands = Brand::all();
        $labels = $data->pluck('month')->unique()->values()->toArray();
        $dataset = [];
        $monthlyProfit = [];

        foreach ($brands as $brand) {
            $brandData = $data->where('brand_id', $brand->id)->pluck('order_count', 'month')->toArray();

            $dataset[] = [
                'label' => $brand->brandName,
                'data' => array_map(function ($month) use ($brandData) {
                    return $brandData[$month] ?? 0;
                }, $labels),
                'borderColor' => '#' . substr(md5($brand->brandName), 0, 6),
                'fill' => false
            ];
        }

        // Calculate monthly profit totals
        foreach ($labels as $month) {
            $monthlyProfit[] = $data->where('month', $month)->sum('total_profit');
        }

        return response()->json([
            'labels' => $labels,
            'dataset' => $dataset,
            'monthlyProfit' => $monthlyProfit
        ]);
    }
}
