<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderSchedule;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Stat cards
        $todayRevenue = Order::whereDate('order_date', $today)->sum('total_price');
        $todayOrders  = Order::whereDate('order_date', $today)->count();
        $newClients   = Order::whereMonth('order_date', $today->month)
                             ->whereYear('order_date', $today->year)
                             ->distinct('customer_phone')->count('customer_phone');
        $monthRevenue = Order::whereMonth('order_date', $today->month)
                             ->whereYear('order_date', $today->year)
                             ->sum('total_price');

        // Pengeluaran bulan ini (dari tabel expenses)
        $monthExpense = Expense::whereMonth('expense_date', $today->month)
                       ->whereYear('expense_date', $today->year)
                       ->sum('amount');

        // Chart per bulan
        $chartRaw = Order::select(
                DB::raw('MONTH(order_date) as month'),
                DB::raw('SUM(total_price) as total'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereYear('order_date', $today->year)
            ->groupBy('month')->orderBy('month')->get();

        $chartLabels = $chartRevenue = $chartOrders = [];
        foreach (range(1, 12) as $m) {
            $chartLabels[]  = Carbon::create(null, $m)->format('M');
            $row = $chartRaw->firstWhere('month', $m);
            $chartRevenue[] = $row ? (int) $row->total  : 0;
            $chartOrders[]  = $row ? (int) $row->jumlah : 0;
        }

        // Pending payment
        $pendingPaymentList = Payment::with(['order.variant.menu'])
                                     ->where('status', 'pending')
                                     ->latest()->take(5)->get();
        $pendingPayments = $pendingPaymentList->count();

        // Menu terlaris
        $topMenus = Order::select(
                'menus.name as menu_name',
                DB::raw('SUM(orders.quantity) as total_qty')
            )
            ->join('menu_variants', 'orders.menu_variant_id', '=', 'menu_variants.id')
            ->join('menus', 'menu_variants.menu_id', '=', 'menus.id')
            ->groupBy('menus.id', 'menus.name')
            ->orderByDesc('total_qty')
            ->take(5)->get();

        // Jadwal minggu ini
        $weekSchedules = OrderSchedule::with(['order.variant.menu'])
                                      ->whereBetween('schedule_date', [
                                          $today->startOfWeek(), $today->copy()->endOfWeek()
                                      ])
                                      ->orderBy('schedule_date')
                                      ->get();

        // Pesanan terbaru
        $recentOrders = Order::with(['variant.menu', 'schedule', 'payment'])
                             ->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'todayRevenue', 'todayOrders', 'newClients', 'monthRevenue',
            'monthExpense', 'chartLabels', 'chartRevenue', 'chartOrders',
            'pendingPayments', 'pendingPaymentList',
            'topMenus', 'weekSchedules', 'recentOrders'
        ));
    }
}
