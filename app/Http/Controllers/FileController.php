<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\StoreFileRequest;
use App\Models\File;
use App\Models\Submission;
use App\Services\FileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class FileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadAllFiles($submissionId)
    {
        $submission = Submission::find($submissionId);
        $ideas = $submission->ideas;

        $zipName = 'ideas-'.$submission->title.'.zip'; // Replace with the desired name of the zip file
        $zipPath = public_path('zip/' . $zipName);

        $zip = new ZipArchive;

        if ($zip->open($zipPath, ZipArchive::CREATE) === true) {
            foreach ($ideas as $idea) {
                if (!$idea->file) continue;
                foreach ($idea->files as $file)
                    $zip->addFile($file->path, $file->filename);
            }
            $zip->close();
            return response()->download($zipPath)->deleteFileAfterSend();
        } else {
            // Zip archive could not be created
            return response('Could not create zip archive', 500);
        }
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
     * @param \App\Http\Requests\File\StoreFileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request, int $ideaId)
    {
        $pdfs = $request->file('files');
        if (!$pdfs) return false;
        foreach ($pdfs as $pdf) {
            $path = $this->saveFileIdeas($pdf);
            $file = new File(
                [
                    "path" => $path,
                    "filename" => $pdf->getClientOriginalName(),
                    "idea_id" => $ideaId
                ]);
            $file->save();
        }
        return true;
    }

    public function saveFileIdeas(UploadedFile $file): string
    {
        $name = uniqid("idea_") . "." . $file->getClientOriginalExtension();
        move_uploaded_file($file->getPathname(), public_path('ideas/' . $name));
        return "ideas/" . $name;
    }
}
