<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('Goodi/Idea/index')
            ->with('listCategories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function edit(Idea $idea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idea $idea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $idea)
    {
        //
    }
}
