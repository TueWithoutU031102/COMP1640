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
        return view('Goodi/Category/index', ['categories' => $categories]);
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
