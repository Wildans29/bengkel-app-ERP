<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // total customer
        $totalCustomer = Customer::count();

        // total transaksi (invoice)
        $totalInvoice = Invoice::count();

        // pendapatan hari ini
        $todayRevenue = Invoice::whereDate('date', now())->sum('total');

        // data chart (30 hari terakhir)
        $chart = Invoice::select(
                DB::raw('DATE(date) as day'),
                DB::raw('SUM(total) as total')
            )
            ->where('date', '>=', now()->subDays(30))
            ->groupBy('day')
            ->orderBy('day')
            ->get();

            $labels = $chart->pluck('day')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'));
            $data = $chart->pluck('total');

        return view('dashboard', compact(
            'totalCustomer',
            'totalInvoice',
            'todayRevenue',
            'labels',
            'data'
        ));
    }
}
