<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Idea;
use Illuminate\Support\Facades\DB;

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

        $activeIT = User::select('id')
            ->where('department_id', '=', '1')
            ->groupBy('id');
        $amountIdeaIT = Idea::select(DB::raw("YEAR(created_at) as year"), DB::raw("COUNT(*) as count"))
            ->groupBy(DB::raw("YEAR(created_at)"))
            ->whereIn('author_id', $activeIT)
            ->pluck('count', 'year');
        $labelsIT = $amountIdeaIT->keys();
        $dataIT = $amountIdeaIT->values();

        $activeBusiness = User::select('id')
            ->where('department_id', '=', '2')
            ->groupBy('id');
        $amountIdeaBusiness = Idea::select(DB::raw("YEAR(created_at) as year"), DB::raw("COUNT(*) as count"))
            ->groupBy(DB::raw("YEAR(created_at)"))
            ->whereIn('author_id', $activeBusiness)
            ->pluck('count', 'year');
        $labelsBusiness = $amountIdeaBusiness->keys();
        $dataBusiness = $amountIdeaBusiness->values();

        $activeDesign = User::select('id')
            ->where('department_id', '=', '3')
            ->groupBy('id');
        $amountIdeaDesign = Idea::select(DB::raw("YEAR(created_at) as year"), DB::raw("COUNT(*) as count"))
            ->groupBy(DB::raw("YEAR(created_at)"))
            ->whereIn('author_id', $activeDesign)
            ->pluck('count', 'year');
        $labelsDesign = $amountIdeaDesign->keys();
        $dataDesign = $amountIdeaDesign->values();

        $dataCountIT = User::join('ideas', 'ideas.author_id', 'users.id')
            ->where('department_id', '1')
            ->select(DB::raw('count(DISTINCT author_id) as author_count'))
            ->pluck('author_count');

        $dataCountBusiness = User::join('ideas', 'ideas.author_id', 'users.id')
            ->where('department_id', '2')
            ->select(DB::raw('count(DISTINCT author_id) as author_count'))
            ->pluck('author_count');

        $dataCountDesign = User::join('ideas', 'ideas.author_id', 'users.id')
            ->where('department_id', '3')
            ->select(DB::raw('count(DISTINCT author_id) as author_count'))
            ->pluck('author_count');


        $goodIdea = Idea::withCount('likes', 'dislikes')
            ->having('likes_count', '>', 'dislikes_count')
            ->get()
            ->count();
        $badIdea = Idea::withCount('likes', 'dislikes')
            ->having('dislikes_count', '>', 'likes_count')
            ->get()
            ->count();
        $totalIdea = Idea::count();

        if ($totalIdea != 0) {
            $countIdeaIT = Idea::whereIn('author_id', $activeIT)->count();
            $countIdeaBussiness = Idea::whereIn('author_id', $activeBusiness)->count();
            $countIdeaDesign = Idea::whereIn('author_id', $activeDesign)->count();
            $percentGoodIdea = number_format(($goodIdea / $totalIdea * 100), 2, '.', '');
            $percentBadIdea = number_format(($badIdea / $totalIdea * 100), 2, '.', '');
            $percentITIdea = number_format(($countIdeaIT / $totalIdea * 100), 2, '.', '');
            $percentBussinessIdea = number_format(($countIdeaBussiness / $totalIdea * 100), 2, '.', '');
            $percentDesignIdea = number_format(($countIdeaDesign / $totalIdea * 100), 2, '.', '');
        } else {
            $percentGoodIdea = 0;
            $percentBadIdea = 0;
            $percentITIdea = 0;
            $percentBussinessIdea = 0;
            $percentDesignIdea = 0;
        }
        return view('Goodi/Dashboard/index', compact(
            'labels',
            'data',
            'labelsIT',
            'dataIT',
            'labelsBusiness',
            'dataBusiness',
            'dataDesign',
            'labelsDesign',
            'dataCountBusiness',
            'dataCountIT',
            'dataCountDesign',
            'totalIdea',
            'percentGoodIdea',
            'percentBadIdea',
            'percentBussinessIdea',
            'percentITIdea',
            'percentDesignIdea'
        ));
    }
}
