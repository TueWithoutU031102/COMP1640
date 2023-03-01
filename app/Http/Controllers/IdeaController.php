<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    //
    public function create(Request $request)
    {
        $idea = new Idea($request->all());
        $authorId = Auth::user()->getAuthIdentifier();
        $listCategories = Category::where('title')->get();
        $category['author_id'] = $authorId;


    }
}
