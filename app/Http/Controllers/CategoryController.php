<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\createCategory;
use App\Http\Requests\Category\editCategory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Idea;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
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
            ->whereIn('author_id', $activeIT)
            ->pluck('count', 'year');

        $labelsBusiness = $amountIdeaIT->keys();
        $dataBusiness = $amountIdeaIT->values();
        return view('Goodi/Category/index', compact('labels', 'data', 'labelsIT', 'dataIT', 'labelsBusiness', 'dataBusiness'), ['categories' => $categories]);
    }

    public function formCreateCategory()
    {
        return view('Goodi/Category/create');
    }

    public function create(createCategory $request)
    {
        $authorId = Auth::user()->getAuthIdentifier();
        $category = new Category($request->all());
        $category['author_id'] = $authorId;

        $category->save();
        return redirect()->route('category.index')->with('errors', 'Create Successful!!!!!');
    }

    public function show($id)
    {
        $category = Category::find($id);
        $name = User::find($category->author_id)->name;
        return view('Goodi/Category/show', ['category' => $category, 'name' => $name]);
    }

    public function formEditCategory($id)
    {
        $category = Category::find($id);
        return view('Goodi/Category/edit', ['category' => $category]);
    }

    public function edit(editCategory $request)
    {
        $category = $request->all();
        $id = $request->id;
        Category::find($id)->update($category);
        return redirect('category/index')->with('success', 'Category updated successfully');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect('category/index')->with('success', 'Category deleted successfully');
    }
}
