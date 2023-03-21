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
//        $labels = $amountIdea->keys();
//        $data = $amountIdea->values();
        $amountIdeaDepartment = DB::table('ideas')
            ->join('users', 'ideas.author_id', '=', 'users.id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->select('departments.name')
            ->pluck('departments.name')
            ->countBy();

        $amountIdeaDepartment = DB::statement("select year(ideas.created_at) as year, count('year')
from ideas
where author_id in (select id from users where department_id = 1 group by id)
group by year
;");
        $amountIdeaDepartment = DB::table('ideas')
            ->select('year(created_at) as year', 'count(year)')
            ->where('author_id', '=', '1' )
            ->groupBy('year');
        dd($amountIdeaDepartment);

        $labels = $amountIdeaDepartment->keys();
        $data = $amountIdeaDepartment->values();

        dd($amountIdea,$amountIdeaDepartment,$data, $labels);
        return view('Goodi/Category/index', compact('labels', 'data'), ['categories' => $categories]);
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
