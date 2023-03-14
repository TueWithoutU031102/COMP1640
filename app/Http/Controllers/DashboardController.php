<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Idea;
use App\Models\User;

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
        //dd($amountIdea);
        $amountAuthor = Idea::select(DB::raw("author_id"))->pluck('author_id');
        // Idea::select(DB::raw("author_id"), DB::raw("COUNT(*) as count"))
        //     ->groupBy(DB::raw("author_id"))
        //     ->pluck('count', 'author_id');
        $so = $amountAuthor->values();
        return view('Goodi/Dashboard/index', compact('labels', 'data'));
    }
}
