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
        $amountIdea = Idea::select(DB::raw("COUNT(*) as count"), DB::raw("YEAR(created_at) as year"))
            ->groupBy(DB::raw("Year(created_at)"))
            ->pluck('count', 'year');
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
