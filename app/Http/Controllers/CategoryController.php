<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\createCategory;
use App\Http\Requests\Category\editCategory;
use App\Models\Category;

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

    public function show($id)
    {
        $category = Category::find($id);
        return view('Goodi/Category/show', ['category' => $category]);
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
        return redirect('Goodi/Category/index', ['category' => $category])->with('success', 'Category updated successfully');;
    }
}
