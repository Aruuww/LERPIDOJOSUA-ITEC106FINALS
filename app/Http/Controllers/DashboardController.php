<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers    = User::count();
        $totalVehicles = Vehicle::count();
        $myVehicles    = auth()->user()->vehicles()->count();

        // Vehicles by type for chart
        $vehicleTypes  = Vehicle::selectRaw('type, count(*) as count')
            ->groupBy('type')->pluck('count', 'type');

        // Vehicles per month (last 6 months)
        $monthlyData = Vehicle::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $months = [];
        $counts = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('M', mktime(0, 0, 0, $i, 1));
            $counts[] = $monthlyData[$i] ?? 0;
        }

        return view('dashboard', compact(
            'totalUsers', 'totalVehicles', 'myVehicles',
            'vehicleTypes', 'months', 'counts'
        ));
    }
}
