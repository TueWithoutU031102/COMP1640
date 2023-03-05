<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Http\UploadedFile;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \App\Http\Requests\StoreFileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        //
        $pdfs = $request->file('files');
        $pdfs[0]->store('idea');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateFileRequest $request
     * @param \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }

    public function saveFile(UploadedFile $file)
    {
        $name = uniqid("idea_") . "." . $file->getClientOriginalExtension();
        move_uploaded_file($file->getPathname(), public_path('idea/' . $name));
        return "idea/" . $name;
    }

    public function handleUpload(Request $request)
    {
        $file = $request->file('files');


        // Do something with the path to the uploaded file...
    }
}
