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
            ->whereIn('author_id', $activeBusiness)
            ->pluck('count', 'year');
        $labelsDesign = $amountIdeaDesign->keys();
        $dataDesign = $amountIdeaDesign->values();

        $countContributorIT = Idea::select(DB::raw("COUNT(*) as count"))
            ->join('users', 'ideas.author_id', '=', 'users.id')
            ->where('department_id', '=', '1')
            ->pluck('count');
        $dataCountIT = $countContributorIT->values();

        $countContributorBusiness = Idea::select(DB::raw("COUNT(*) as count"))
            ->join('users', 'ideas.author_id', '=', 'users.id')
            ->where('department_id', '=', '2')
            ->pluck('count');
        $dataCountBusiness = $countContributorBusiness->values();

        $countContributorDesign = Idea::select(DB::raw("COUNT(*) as count"))
            ->join('users', 'ideas.author_id', '=', 'users.id')
            ->where('department_id', '=', '3')
            ->pluck('count');
        $dataCountDesign = $countContributorDesign->values();

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
            $percentGoodIdea = number_format(($goodIdea / $totalIdea * 100), 2, '.', '');
            $percentBadIdea = number_format(($badIdea / $totalIdea * 100), 2, '.', '');
            $percentITIdea = number_format(($amountIdeaIT->count() / $totalIdea * 100), 2, '.', '');
            $percentBussinessIdea = number_format(($amountIdeaBusiness->count() / $totalIdea * 100), 2, '.', '');
            $percentDesignIdea = number_format(($amountIdeaDesign->count() / $totalIdea * 100), 2, '.', '');
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
