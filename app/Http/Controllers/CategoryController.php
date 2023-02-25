<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\createCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('Goodi/Category/index', ['categories' => $categories]);
    }

    public function formCreateCategory()
    {
        return view('Goodi/Category/create');
    }

    public function create(createCategory $request)
    {
        $category = new Category($request->all());

        $category->save();
        return redirect()->route('category.index')->with('errors', 'Create Successful!!!!!');
    }
}
