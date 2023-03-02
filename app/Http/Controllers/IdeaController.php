<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    //
    public function index()
    {
        $listCategories = Category::all();

        $idea = Idea::all();
        dd($listCategories);
        return view('Goodi.Idea.index', ['idea' => $idea, 'listCategories' => $listCategories]);
    }

    public function create(Request $request)
    {
        $idea = new Idea($request->all());
        $authorId = Auth::user()->getAuthIdentifier();
        $idea['author_id'] = $authorId;

        $idea->save();
        return redirect()->route('indexIdea');
    }
}
