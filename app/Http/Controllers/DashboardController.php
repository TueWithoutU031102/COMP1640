<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Idea;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $amountIdea = Idea::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count', 'month_name');

        $labels = $amountIdea->keys();
        $data = $amountIdea->values();
        return view('Goodi/Dashboard/index', compact('labels', 'data'));
    }
}
